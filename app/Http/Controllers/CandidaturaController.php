<?php

namespace App\Http\Controllers;

use App\Models\Fio\Turma;
use Illuminate\Http\Request;
use App\Models\Enoaa\Ano;
use App\Models\Enoaa\Candidato;
use App\Models\Enoaa\Candidatura;
use App\Models\Enoaa\Examecandidato;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Fio\Formacao;
use App\Models\Enoaa\Pessoa;
use App\Models\User;
use Illuminate\Support\Str;

class CandidaturaController extends Controller
{

    public function store(Request $request)
    {
        $valida = $this->validaDados($request->email, $request->tel1, $request->tel2, $request->num_cedula, $request->formacao);
        if ($valida == 'true') {

            $validated = $request->validate([
                'cedula_advogado' => 'required',
                'bilhete_identidade' => 'required'
            ]);

            // $validated = $request->validate([
            //     'doc_bi' => 'required|mimetypes:application/pdf|max:10000',
            //     'doc_diploma' => 'required|mimetypes:application/pdf|max:10000',
            // ]);


            // verifica se ainda tem vaga disponível
            $turma = Turma::find($request->turma);
            $capacidade = $turma->capacidade;
            $inscricoes = Candidaturaformacao::where('turma_id', $turma->id)->count();
            $vagas = ($capacidade - $inscricoes);
            
            if ($vagas <= 0) {
                return 'espaco';
            } else {

                // inserir pessoa
                $pessoa = PessoaController::inserirPessoa($request->nome_completo, null, $request->email, $request->genero, $request->tel1, $request->tel2);

                // pega o ano actual
                $ano_activo = Ano::where('estado', 'Activo')->first();

                // formação em que se inscreveu
                $form_inscrito = Formacao::find($request->formacao);

                // conta as candidaturas nesta formação naquele ano
                $conta = Candidaturaformacao::where('year_id', $ano_activo->id)
                    ->whereNull('deleted_at')
                    ->count();

                if ($conta == null || $conta == 0) {
                    $conta = 1;
                } else {
                    $conta = $conta + 93 + 1;
                }

                $codigo = '';

                if ($form_inscrito->tipoformacao_id == 1) {
                    $codigo = 'FIO' . $conta . '-' . $ano_activo->descricao;
                } else {
                    $codigo = 'FE' . $conta . '-' . $ano_activo->descricao;
                }

                //inserir candidatura
                $candidatura = Candidaturaformacao::create([
                    'pessoa_id' => $pessoa->id,
                    'year_id' => $ano_activo->id,
                    'formacao_id' => $form_inscrito->id,
                    'pintar' => 'Não',
                    'estado' => 'pendente',
                    'nome_patrono' => $request->nome_patrono,
                    'email_patrono' => $request->email_patrono,
                    'telefone_patrono' => $request->telefone_patrono,
                    'nome_escritorio' => $request->nome_escritorio,
                    'endereco_escritorio' => $request->endereco_escritorio,
                    'turma_id' => $request->turma,
                    'num_cedula' => $request->num_cedula,
                    'pago' => 'não pago',
                    'codigo' => $codigo,
                    'hash' => md5($codigo . $pessoa->id . $pessoa->created_at)
                ]);

                //faz upload dos documentos
                $cedula_advogado = '';
                $bilhete_identidade = '';

                //cédula do advogado
                try {
                    if ($request->hasFile('cedula_advogado') && $request->file('cedula_advogado')->isValid()) {
                        $cedula_advogado = $request->cedula_advogado->store('candidaturas/' . $form_inscrito->getTipoformacao->codigo . '/' . $ano_activo->descricao . '/' . $codigo);
                        // $cedula_advogado = $request->doc_bi->storeAs('candidaturas/' . $form_inscrito->codigo . '/' . $ano_activo->descricao . '/' . $codigo , 'doc_identificação_' . $candidato->id . '.pdf');
                        $candidatura->cedula_advogado = $cedula_advogado;
                        $candidatura->save();
                    }
                } catch (Throwable $error) {
                    // throw new Exception($error);
                }

                //bilhete de identidade
                try {
                    if ($request->hasFile('bilhete_identidade') && $request->file('bilhete_identidade')->isValid()) {
                        $bilhete_identidade = $request->bilhete_identidade->store('candidaturas/' . $form_inscrito->getTipoformacao->codigo . '/' . $ano_activo->descricao . '/' . $codigo);
                        // $cedula_advogado = $request->doc_bi->storeAs('candidaturas/' . $form_inscrito->codigo . '/' . $ano_activo->descricao . '/' . $codigo , 'doc_identificação_' . $candidato->id . '.pdf');
                        $candidatura->bilhete_identidade = $bilhete_identidade;
                        $candidatura->save();
                    }
                } catch (Throwable $error) {
                    // throw new Exception($error);
                }
                
                
                // envia email
                $token = Str::random(64);
                $ob = new MailController();
                $res = $ob->mailRegisto($pessoa->email, $pessoa->nome);

                if ($res == true) {
                    // regista actividade do sistema
                    ActividadesistemaController::inserir(null, 'Enviou email com as credenciais de acesso', 'Sistema', 'candidatura', $candidatura->id);
                    $candidatura->email_registo = 'Sim';
                    $candidatura->save();
                } else {
                    $candidatura->email_registo = 'Não';
                    $candidatura->save();
                }
                

                // inserir usuario
                $password = 'CEF' . $codigo . $candidatura->id . 'OAA';
                $usuario = User::create([
                    'primeiro_acesso' => 'Sim',
                    'ativo' => 'Sim',
                    'acesso_enoaa' => 'Não',
                    'acesso_fio' => 'Sim',
                    'password' => md5($password),
                    'permission_id' => 5,
                    'pessoa_id' => $pessoa->id
                ]);

                $usuario->hash = md5($usuario->id . $password);
                $usuario->save();

                // regista actividade do sistema
                ActividadesistemaController::inserir($usuario->id, 'Submeteu a sua inscrição', 'Candidato', 'candidatura', $candidatura->id);


                return 'sucesso';
            }
        } else {
            return $valida;
        }
    }

    public function validaDados($email, $tel, $tel2, $cedula, $formacao)
    {

        $result = Pessoa::where('email', $email)->first();
        if ($result != null) {
            return 'email';
        } else {
            $result = Pessoa::where('telefone1', $tel)->first();
            if ($result != null) {
                return 'telefone1';
            } else {
                $result = Pessoa::where('telefone2', $tel)->first();
                if ($result != null) {
                    return 'telefone1';
                } else {
                    $result = Pessoa::where('telefone1', $tel2)->first();
                    if ($result != null) {
                        return 'telefone2';
                    } else {
                        $result = Pessoa::where('telefone2', $tel2)->first();
                        if ($result != null) {
                            return 'telefone2';
                        } else {
                            $result = Candidaturaformacao::where('num_cedula', $cedula)->where('formacao_id', $formacao)->first();
                            if ($result != null) {
                                return 'cedula';
                            }
                        }
                    }
                }
            }
        }

        return 'true';
    }

    public function storeEnoaa(Request $request)
    {

        $validated = $request->validate([
            'cedula_advogado' => 'required'
        ]);

        // verifica se este email já tem acesso ao FIO
        $verifica = Pessoa::where('email', $request->email)->first();
        if ($verifica) {
            $user = User::where('pessoa_id', $verifica->id)
                ->where('acesso_fio', 'Sim')
                ->first();

            if ($user) {
                return 'conta existe';
            } else {
                // verificar veracidade do documento de identificação
                if ($verifica->num_documento == $request->num_documento) {

                    // verifica se o código é verdadeiro
                    $candidato = Candidato::where('pessoa_id', $verifica->id)->first();
                    if ($candidato) {
                        $candidatura = Candidatura::where('candidato_id', $candidato->id)
                            ->where('codigo', $request->codigo)->first();

                        if ($candidatura) {

                            // verifica se aprovou no enooa
                            $exame = Examecandidato::where('candidatura_id', $candidatura->id)
                                // ->where('total', '>=', 9.5)
                                ->first();

                            if (true) {

                                $codigo_validacao = $candidatura->codigo . $verifica->id . $candidato->id;

                                // pega o ano actual
                                $ano_activo = Ano::where('estado', 'Activo')->first();

                                // formação em que se inscreveu
                                $form_inscrito = Formacao::find($request->formacao);

                                // conta as candidaturas nesta formação naquele ano
                                $conta = Candidaturaformacao::where('year_id', $ano_activo->id)
                                    ->where('formacao_id', $form_inscrito->id)
                                    ->count();

                                if ($conta == null || $conta == 0) {
                                    $conta = 1;
                                } else {
                                    $conta = $conta + 1;
                                }

                                $codigo = '';

                                if ($form_inscrito->tipoformacao_id == 1) {
                                    $codigo = 'FIO' . $conta . '-' . $ano_activo->descricao;
                                } else {
                                    $codigo = 'FE' . $conta . '-' . $ano_activo->descricao;
                                }

                                // inserir candidatura
                                $candidatura = Candidaturaformacao::create([
                                    'pessoa_id' => $verifica->id,
                                    'year_id' => $ano_activo->id,
                                    'formacao_id' => $form_inscrito->id,
                                    'pintar' => 'Não',
                                    'estado' => 'validar',
                                    'pago' => 'não pago',
                                    'codigo' => $codigo,
                                    'codigo_validacao' => $codigo_validacao,
                                    'hash' => md5($codigo . $verifica->id . $verifica->num_documento)
                                ]);

                                //faz upload dos documentos
                                $cedula_advogado = '';

                                //cédula do advogado
                                try {
                                    if ($request->hasFile('cedula_advogado') && $request->file('cedula_advogado')->isValid()) {
                                        $cedula_advogado = $request->cedula_advogado->store('candidaturas/' . $form_inscrito->getTipoformacao->codigo . '/' . $ano_activo->descricao . '/' . $codigo);
                                        // $cedula_advogado = $request->doc_bi->storeAs('candidaturas/' . $form_inscrito->codigo . '/' . $ano_activo->descricao . '/' . $codigo , 'doc_identificação_' . $candidato->id . '.pdf');
                                        $candidatura->cedula_advogado = $cedula_advogado;
                                        $candidatura->save();
                                    }
                                } catch (Throwable $error) {
                                    // throw new Exception($error);
                                }

                                // mandar SMS de validação
                                // $ob = new MailController();
                                // $res = $ob->mailValidacao($verifica->email, $verifica->nome, $codigo);
                                // if($res == true){
                                //     return 'sucesso';
                                // }

                                return 'sucesso';
                            } else {
                                return 'reprovou';
                            }
                        } else {
                            return 'código inválido';
                        }
                    } else {
                        return 'não é candidato';
                    }
                } else {
                    return 'documento inválido';
                }
            }
        } else {
            return 'não existe';
        }
    }

    public function validaStoreEnoaa(Request $request)
    {

        $validated = $request->validate([
            'codigo_validacao' => 'required'
        ]);

        // verifica se o código está certo
        $candidatura = Candidaturaformacao::where('codigo_validacao', $request->codigo_validacao)->first();
        if ($candidatura) {

            $pessoa = Pessoa::find($candidatura->pessoa_id);
            $user = User::where('pessoa_id', $pessoa->id)->first();

            $user->acesso_fio = 'Sim';
            $user->save();
            $candidatura->estado = 'pendente';
            $candidatura->codigo_validacao = '';
            $candidatura->save();

            return 'sucesso';
        } else {
            return 'erro';
        }
    }
}
