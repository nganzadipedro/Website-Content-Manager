<?php

namespace App\Http\Controllers;

use App\Lib\Repositories\CursoRepository;
use App\Models\Curso;
use App\Models\Fio\Atribuicaoalunoprova;
use App\Models\Fio\Avaliacaoaluno;
use App\Models\Fio\Pagamento;
use App\Models\Fio\Actividadesistema;
use Illuminate\Http\Request;
use App\Lib\Traits\UserTrait;
use App\Models\AdminInstituicao;
use App\Models\Candidato;
use App\Models\Candidatura;
use App\Models\CoordenadorCurso;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Fio\Aluno;
use App\Models\Fio\Turma;
use App\Models\Fio\Formacao;
use App\Models\Fio\Alunoformacao;
use App\Models\Enoaa\Pessoa;
use App\Models\Provincia;
use App\Models\ResponsavelTurma;
use App\Http\Controllers\ActividadesistemaController;
use App\Http\Controllers\ProxyPayController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class UserController extends Controller
{


    public function tratadados()
    {

        $candidaturas = Candidaturaformacao::where('estado', 'aprovado')
            ->where('pago', 'pago')
            ->where('turma_id', 5)
            ->get();

        //dd($candidaturas);
        foreach ($candidaturas as $item) {

            // se não tem hash
            if ($item->hash == null) {
                $item->hash = md5($item->id . $item->created_at);
                $item->save();
            }

            // trata dados do aluno
            $existe = Aluno::where('pessoa_id', $item->pessoa_id)->first();
            $aluno = null;
            if ($existe) {
                $aluno = $existe;
                $aluno->hash = md5($aluno->id . $aluno->created_at . $item->pessoa_id);
                $aluno->save();
            } else {
                $aluno = Aluno::create([
                    'pessoa_id' => $item->pessoa_id,
                    'codigo' => $item->codigo,
                    'hash' => md5($item->id . $item->created_at . $item->pessoa_id),
                    'num_cedula_advogado' => $item->num_cedula,
                    'documento_bilhete' => $item->bilhete_identidade,
                    'documento_cedula' => $item->cedula_advogado,
                    'nome_patrono' => $item->nome_patrono,
                    'email_patrono' => $item->email_patrono,
                    'telefone_patrono' => $item->telefone_patrono,
                    'nome_escritorio' => $item->nome_escritorio,
                    'endereco_escritorio' => $item->endereco_escritorio
                ]);
            }

            $item->aluno_id = $aluno->id;
            $item->save();

            // trata aluno formação
            $existe = Alunoformacao::where('aluno_id', $aluno->id)->first();
            if ($existe) {
                $existe->turma_id = $item->turma_id;
                $existe->formacao_id = $item->formacao_id;
                $existe->save();
            } else {
                $aluno_formacao = Alunoformacao::create([
                    'aluno_id' => $aluno->id,
                    'turma_id' => $item->turma_id,
                    'formacao_id' => $item->formacao_id
                ]);
            }

        }

    }

    public function unica_referencia($codigo)
    {


        $candidatura = Candidaturaformacao::find($codigo);
        //dd($candidatura);

        if ($candidatura) {

            $tel = $candidatura->getPessoa->telefone1;
            $email = $candidatura->getPessoa->email;
            $nome = $candidatura->getPessoa->nome;

            //dd($nome);

            $ob = new ProxyPayController();
            $referencia = $ob->gerarReferencia($tel, $email, $nome, 70000, 3);
            //$referencia = 'teste mais';
            $today = Carbon::today();
            $data_expiracao = $today->addDays(3);

            $candidatura->estado = 'aprovado';
            $candidatura->referencia = $referencia;
            // $candidatura->turma_id = 5;
            $candidatura->validade_referencia = $data_expiracao;
            $candidatura->save();

            // regista actividade do sistema
            ActividadesistemaController::inserir(null, 'Enviou a referência de pagamento por SMS', 'Sistema', 'candidatura', $candidatura->id);

            echo $nome . 'enviou mais <br>';
            echo $referencia . '<br><br>';

        } else {

            dd('candidatura não encontrada');

        }

    }

    public function transformar_pago($id)
    {

        $candidatura = Candidaturaformacao::find($id);
        $user = User::where('pessoa_id', $candidatura->pessoa_id)->first();

        //dd($user);

        // gera factura de pagamento
        //$ob = new FactPlusController();
        //$ref_factura = $ob->gerarFacturaRecibo($candidatura->getPessoa->email, 'Luanda', $candidatura->getPessoa->nome);

        $candidatura->pago = 'pago';
        // $candidatura->referencia_factura = $ref_factura;
        $candidatura->save();

        // insere na tabela de alunos
        $existe = Aluno::where('pessoa_id', $candidatura->pessoa_id)->first();
        $aluno = null;
        if ($existe) {
            $aluno = $existe;
        } else {
            $aluno = Aluno::create([
                'pessoa_id' => $candidatura->pessoa_id,
                'codigo' => $candidatura->codigo,
                'num_cedula_advogado' => $candidatura->num_cedula,
                'documento_bilhete' => $candidatura->bilhete_identidade,
                'documento_cedula' => $candidatura->cedula_advogado,
                'nome_patrono' => $candidatura->nome_patrono,
                'email_patrono' => $candidatura->email_patrono,
                'telefone_patrono' => $candidatura->telefone_patrono,
                'nome_escritorio' => $candidatura->nome_escritorio,
                'endereco_escritorio' => $candidatura->endereco_escritorio
            ]);
        }

        $candidatura->aluno_id = $aluno->id;
        $candidatura->save();

        // insere na tabela aluno_formacao
        $existe = Alunoformacao::where('aluno_id', $aluno->id)->first();
        if ($existe) {
            $existe->turma_id = $candidatura->turma_id;
            $existe->formacao_id = $candidatura->formacao_id;
            $existe->save();
        } else {
            $aluno_formacao = Alunoformacao::create([
                'aluno_id' => $aluno->id,
                'turma_id' => $candidatura->turma_id,
                'formacao_id' => $candidatura->formacao_id
            ]);
        }

        // insere na tabela de pagamentos
        $pagamento = Pagamento::create([
            'aluno_id' => $aluno->id,
            'formacao_id' => $candidatura->formacao_id,
            'descricao' => "Pagamento da inscrição",
            'emolumento_id' => 1,
            'referencia' => $candidatura->referencia,
            //  'referencia_factura' => $ref_factura,
            'forma_pagamento' => 'Referência',
            'ano_id' => $candidatura->year_id
        ]);

        /* envia email de confirmação de pagamento
        $ob = new MailController();
        $res = $ob->mailPagamento($candidatura->getPessoa->nome, $candidatura->getPessoa->email);
        if ($res == true) {
            // regista actividade do sistema
            ActividadesistemaController::inserir(null, 'Enviou email de confirmação de pagamento', 'Sistema', 'candidatura', $candidatura->id);
        }
        */

        // altera o estado da factura
        //$ob = new FactPlusController();
        //$ob->alterarEstado($ref_factura);

        // envia mail com a factura
        //$ob->enviarEmail($ref_factura, $candidatura->getPessoa->email);

        // regista actividade do sistema
        //ActividadesistemaController::inserir($user->id, 'Fez o pagamento da inscrição', 'Candidato', 'candidatura', $candidatura->id);

        return $candidatura;

    }

    public function trata_dados()
    {

        $candidaturas = Candidaturaformacao::
            where('turma_id', 8)
            ->get();

        $cont = 0;

        //dd($candidaturas);
        foreach ($candidaturas as $item) {

            // se não tem hash
            $item->hash = md5($item->id . $item->created_at);
            $item->codigo = 'FIO' . $item->id . '-2024';
            $item->save();

            // trata dados do aluno
            if ($item->pago == 'pago' && $item->estado == 'aprovado') {
                $existe = Aluno::where('pessoa_id', $item->pessoa_id)->first();
                $aluno = null;
                if ($existe) {
                    $aluno = $existe;
                    $aluno->hash = md5($aluno->id . $aluno->created_at . $item->pessoa_id);
                    $aluno->codigo = $item->codigo;
                    $aluno->num_cedula_advogado = $item->num_cedula;
                    $aluno->documento_bilhete = $item->bilhete_identidade;
                    $aluno->documento_cedula = $item->cedula_advogado;
                    $aluno->nome_patrono = $item->nome_patrono;
                    $aluno->email_patrono = $item->email_patrono;
                    $aluno->telefone_patrono = $item->telefone_patrono;
                    $aluno->nome_escritorio = $item->nome_escritorio;
                    $aluno->endereco_escritorio = $item->endereco_escritorio;
                    $aluno->save();
                } else {
                    $aluno = Aluno::create([
                        'pessoa_id' => $item->pessoa_id,
                        'codigo' => $item->codigo,
                        'hash' => md5($item->id . $item->created_at . $item->pessoa_id),
                        'num_cedula_advogado' => $item->num_cedula,
                        'documento_bilhete' => $item->bilhete_identidade,
                        'documento_cedula' => $item->cedula_advogado,
                        'nome_patrono' => $item->nome_patrono,
                        'email_patrono' => $item->email_patrono,
                        'telefone_patrono' => $item->telefone_patrono,
                        'nome_escritorio' => $item->nome_escritorio,
                        'endereco_escritorio' => $item->endereco_escritorio
                    ]);
                }

                $item->aluno_id = $aluno->id;
                $item->save();

                // trata aluno formação
                $existe = Alunoformacao::where('aluno_id', $aluno->id)->first();
                if ($existe) {
                    // não faz nada
                } else {
                    $aluno_formacao = Alunoformacao::create([
                        'aluno_id' => $aluno->id,
                        'turma_id' => $item->turma_id,
                        'formacao_id' => $item->formacao_id
                    ]);
                }

                $cont++;
            }




        }

        return $cont;
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function insertAdmin()
    {
        $pessoa = PessoaController::inserirPessoa('Nganzadi Nsimba Pedro', '005691422BO048', 'nganzadipedro.emp@gmail.com', 'Bilhete de Identidade', 'Masculino', '941451449', null);
        $usuario = User::create([
            'primeiro_acesso' => 'Sim',
            'ativo' => 'Sim',
            'password' => md5('EN' . $pessoa->id . 'OAA'),
            'permission_id' => 1,
            'pessoa_id' => $pessoa->id
        ]);

        $usuario->hash = md5($usuario->id . $usuario->password);
        $usuario->save();
        return $usuario;
    }

    public function store(Request $request)
    {
        $user = User::create([
            'nome' => $request->nome,
            'num_bi' => $request->num_bi,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'password' => $request->num_bi,
            'permissao_id' => $request->permissao_id
        ]);

        if ($request->permissao_id == 2) {
            $admin_inst = AdminInstituicao::create([
                'user_id' => $user->id,
                'instituicao_id' => $request->instituicao_id
            ]);
        } else if ($request->permissao_id == 3) {
            $coord_curso = CoordenadorCurso::create([
                'user_id' => $user->id,
                'curso_id' => $request->curso_id
            ]);
        } else if ($request->permissao_id == 4) {
            $resp_turma = ResponsavelTurma::create([
                'user_id' => $user->id,
                'turma_id' => $request->turma_id
            ]);
        }

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFoto(Request $request)
    {
        $validated = $request->validate([
            'fotografia' => 'required|mimetypes:image/png|max:10000'
        ]);

        $pessoa = Pessoa::find(Auth::user()->pessoa_id);
        $fotografia = '';

        // pessoa
        try {
            if ($request->hasFile('fotografia') && $request->file('fotografia')->isValid()) {
                $fotografia = $request->fotografia->storeAs('usuarios/images', 'avatar_' . $pessoa->id . '.png');
                $pessoa->avatar = $fotografia;
                $pessoa->save();
            }
        } catch (Throwable $error) {
            // throw new Exception($error);
        }

        return 'sucesso';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function perfil()
    {

        $candidatura = '';
        $usuario = User::find(Auth::user()->id);
        $pessoa = Pessoa::find($usuario->pessoa_id);

        $doc_bi = false;
        $doc_ced = false;

        if ($usuario->permission_id == 5) {
            $candidatura = Candidaturaformacao::where('pessoa_id', $pessoa->id)->first();

            $exists = Storage::disk(name: 'public')->exists('' . $candidatura->cedula_advogado);
            if ($exists) {
                $doc_ced = true;
            }

            $exists = Storage::disk(name: 'public')->exists('' . $candidatura->bilhete_identidade);
            if ($exists) {
                $doc_bi = true;
            }
        }

        return view('auth.profile', compact('usuario', 'candidatura', 'pessoa', 'doc_ced', 'doc_bi'));
    }

    public function actualizar($aluno_hash)
    {

        $candidatura = '';
        $aluno = Aluno::where('hash', $aluno_hash)->first();
        $pessoa = Pessoa::find($aluno->pessoa_id);
        $usuario = User::where('pessoa_id', $pessoa->id)->first();

        $doc_bi = false;
        $doc_ced = false;

        if ($usuario->permission_id == 5) {
            $candidatura = Candidaturaformacao::where('pessoa_id', $pessoa->id)->first();

            $exists = Storage::disk(name: 'public')->exists('' . $candidatura->cedula_advogado);
            if ($exists) {
                $doc_ced = true;
            }

            $exists = Storage::disk(name: 'public')->exists('' . $candidatura->bilhete_identidade);
            if ($exists) {
                $doc_bi = true;
            }
        }

        return view('dashboard.admin.formando.actualizar', compact('usuario', 'candidatura', 'pessoa', 'doc_ced', 'doc_bi'));
    }

    public function updateSenha(Request $request)
    {

        $usuario = User::find(Auth::user()->id);

        if ($usuario->password == md5($request->antiga)) {

            // verificação da senha
            if (strlen($request->nova) >= 8) {

                $usuario->password = md5($request->nova);
                $usuario->save();

                // gerar historico
                ActividadesistemaController::inserir(Auth::id(), "Alterou a sua senha de acesso", 'Candidato', 'conta');

                return 'sucesso';
            } else {
                return 'seguranca';
            }
        } else {
            return 'incorrecta';
        }
    }

    public function senhaValida($senha)
    {
        return preg_match('/^[\w$@]{8,}$/', $senha);

        return preg_match('/[a-z]/', $senha) // tem pelo menos uma letra minúscula
            && preg_match('/[A-Z]/', $senha) // tem pelo menos uma letra maiúscula
            && preg_match('/[0-9]/', $senha) // tem pelo menos um número
            && preg_match('/^[\w$@]{8,}$/', $senha); // tem 6 ou mais caracteres
    }

    public function referencias()
    {

        $candidaturas = Candidaturaformacao::where('estado', 'aprovado')
            ->where('pago', 'não pago')
            ->where('turma_id', 4)
            ->get();

        // dd($candidaturas);
        // ->whereNotNull('referencia')->get();

        //$dados = DB::connection('mysql')->select("select * from tab2_referencia where disponivel != 'Não' and enviado = 0");

        $ob = new ProxyPayController();
        $cont = 1;

        foreach ($candidaturas as $linha) {

            set_time_limit(0);

            // envia as referências

            $candidatura = Candidaturaformacao::find($linha->id);

            $tel = $candidatura->getPessoa->telefone1;
            $email = $candidatura->getPessoa->email;
            $nome = $candidatura->getPessoa->nome;

            //dd($nome);


            $referencia = $ob->gerarReferencia($tel, $email, $nome, 70000, 3);
            //$referencia = 'teste mais';
            $today = Carbon::today();
            $data_expiracao = $today->addDays(3);

            $cand = Candidaturaformacao::find($linha->id);
            $cand->estado = 'aprovado';
            $cand->referencia = $referencia;
            //$cand->turma_id = 4;
            $cand->validade_referencia = $data_expiracao;
            $cand->save();

            // gerar historico
            //ActividadesistemaController::inserir(1, 'Aprovou a candidatura', 'CEF', 'candidatura', $linha->id);

            // regista actividade do sistema
            ActividadesistemaController::inserir(null, 'Enviou a referência de pagamento por SMS', 'Sistema', 'candidatura', $linha->id);

            //$res = DB::connection('mysql')->update("update tab2_referencia set enviado = 1 where id = $linha->id");

            echo $cont . ') ' . $nome . 'enviou nova referencia <br>';
            echo $referencia . '<br><br>';
            $cont++;


        }

        return count($candidaturas);
    }


    public function referencias_espec()
    {

        $candidaturas = DB::connection('mysql')->select("select * from formacao_espec where enviado = 'Não'");
        //dd($candidaturas);

        $ob = new ProxyPayController();
        $cont = 1;

        foreach ($candidaturas as $linha) {

            set_time_limit(0);

            // envia as referências

            $tel = $linha->telefone;
            $email = strtolower($linha->email);
            $nome = strtoupper($linha->nome);
            $id = $linha->id;

            // dd($nome);

            $referencia = $ob->gerarReferencia($tel, $email, $nome, 60000, 3);

            $today = Carbon::today();
            $data_expiracao = $today->addDays(3);

            $res = DB::connection('mysql')->update("update formacao_espec set referencia = $referencia, validade_ref = '$data_expiracao' where id = $id");

            echo $cont . ') ' . $nome . 'enviou nova referencia <br>';
            echo $referencia . '<br><br>';
            $cont++;


        }

        return count($candidaturas);
    }

    public function unica_referencia2($codigo)
    {


        $candidatura = Candidaturaformacao::find($codigo);
        //dd($candidatura);

        if ($candidatura) {

            $tel = $candidatura->getPessoa->telefone1;
            $email = $candidatura->getPessoa->email;
            $nome = $candidatura->getPessoa->nome;

            //dd($nome);

            $ob = new ProxyPayController();
            $referencia = $ob->gerarReferencia($tel, $email, $nome, 70000, 3);
            //$referencia = 'teste mais';
            $today = Carbon::today();
            $data_expiracao = $today->addDays(3);

            $candidatura->estado = 'aprovado';
            $candidatura->referencia = $referencia;
            $candidatura->turma_id = 5;
            $candidatura->validade_referencia = $data_expiracao;
            $candidatura->save();

            // regista actividade do sistema
            ActividadesistemaController::inserir(null, 'Enviou a referência de pagamento por SMS', 'Sistema', 'candidatura', $candidatura->id);

            echo $nome . 'enviou mais <br>';
            echo $referencia . '<br><br>';

        } else {

            dd('candidatura não encontrada');

        }

    }

    public function credenciais($id)
    {

        $candidaturas = Alunoformacao::where('turma_id', $id)->get();
        //dd($candidaturas);

        //$ob = new MIMOController();
        //$ob->enviarMensagem('941451449', 'mensagem de teste');
        //dd('teste');

        foreach ($candidaturas as $item) {

            set_time_limit(0);

            $telefone = $item->getAluno->getPessoa->telefone1;
            $nome = $item->getAluno->getPessoa->nome;
            $email = $item->getAluno->getPessoa->email;

            //dd($email);

            $user = User::where('pessoa_id', $item->getAluno->pessoa_id)->first();
            if ($user) {
                $senha = 'CEF' . $user->pessoa_id . $user->id . $item->turma_id;
                $senha_cript = md5($senha);
                $user->password = $senha_cript;
                $user->save();

                $mensagem = "Prezado(a) candidato(a) $nome, seguem as credenciais de acesso a plataforma. Email: $email | Senha: $senha";

                $ob = new MIMOController();
                $ob->enviarMensagem($telefone, $mensagem);
                echo $nome . ' <br><br>';
            } else {
                echo $nome . ' ' . $item->getAluno->pessoa_id . ' ' . '(sem usuário) <br><br>';
            }


        }


    }

    public function verificando_provas()
    {
        $provas = Atribuicaoalunoprova::where('prova_id', "<", "5")->get();


        foreach ($provas as $pv) {
            $existe = Atribuicaoalunoprova::where('prova_id', '<', 5)
                ->where('aluno_id', $pv->aluno_id)->get();

            if (count($existe) > 1) {
                echo $pv->aluno_id;
                echo '<br>';
            }
        }
    }

    public function sendMessage()
    {

        //  $candidaturas = Candidaturaformacao::where('estado', 'aprovado')
        // ->where('pago', 'pago')
        // ->where('turma_id', 2)
        // ->where('year_id', 2)
        // ->get();

        $candidatos = DB::select("select * from formacao_espec where id > 123");
        // dd($candidatos);

        $mensagem = 'Seja bem-vindo à FORMAÇÃO ESPECIALIZADA; Prezado(a) Formando(a); Entre no grupo da turma https://chat.whatsapp.com/CRojLieILOMDvLzgN04DRw';

        // $ob->enviarMensagem("941451449", $mensagem);
        // die();

        foreach ($candidatos as $linha) {

            set_time_limit(0);

            $telefone = $linha->telefone;
            $nome = $linha->nome;
            //dd($telefone);
            $ob = new MIMOController();
            $ob->enviarMensagem($telefone, $mensagem);
            echo $nome . ' <br><br>';

            // $res = DB::update("update candidatos_palestra set enviado = 'sim' where id = $linha->id");

        }

        return count($candidatos);
    }

    public function sendMail()
    {

        $candidatos = DB::select("select * from respostas_formulario where enviado = 'nao'");


        $ob = new MailController();

        $cont = 1;

        foreach ($candidatos as $linha) {

            set_time_limit(0);

            // envia o email
            $email = strtolower($linha->email);
            $nome = $linha->nome_completo;

            $res = $ob->turmaC($email, $nome);
            if ($res == true) {
                echo $cont . ') ' . $nome . ' <br><br>';
            }

            $res = DB::update("update respostas_formulario set enviado = 'sim' where id = $linha->id");

            $cont++;

        }

        return count($candidatos);
    }

    public function notas()
    {

        $res = DB::select("select * from pautafinal33_turmac where importado = 0 and codigo is not null");
        //dd($res);

        foreach ($res as $linha) {

            $cand = Candidaturaformacao::where("codigo", $linha->codigo)->first();
            if ($cand) {

                $aluno = Aluno::where("pessoa_id", $cand->pessoa_id)->first();
                if ($aluno) {

                    $af = Alunoformacao::where("aluno_id", $aluno->id)->first();
                    if ($af) {

                        $notas[0] = $linha->proc_penal;
                        $notas[1] = $linha->pratica_proc_civil;
                        $notas[2] = $linha->etica;
                        $notas[3] = $linha->praticas_juridicas_mult;
                        $notas[4] = $linha->laboral;

                        for ($i = 1; $i <= 5; $i++) {

                            $existe = Avaliacaoaluno::where('aluno_id', $aluno->id)
                                ->where('formacao_id', $af->formacao_id)
                                ->where('turma_id', $af->turma_id)
                                ->where('disciplina_id', $i)
                                ->first();

                            if ($existe) {
                                $existe->notafinal = $notas[$i - 1];
                                $existe->nota2 = 0;
                                $existe->save();
                            } else {
                                $av = Avaliacaoaluno::create([
                                    'aluno_id' => $aluno->id,
                                    'formacao_id' => $af->formacao_id,
                                    'turma_id' => $af->turma_id,
                                    'disciplina_id' => $i,
                                    'notafinal' => $notas[$i - 1]
                                ]);
                            }
                        }

                        $id = $linha->id;
                        $res = DB::update("update pautafinal33_turmac set importado=1 where id = $id");

                        echo $aluno->getPessoa->nome;
                        echo '<br><br>';

                    } else {

                        echo 'aluno-formação não encontrado ' . $linha->codigo;
                        echo '<br><br>';

                    }

                } else {
                    echo 'aluno não encontrado ' . $linha->codigo;
                    echo '<br><br>';
                }

            } else {
                echo 'candidatura não encontrada ' . $linha->codigo;
                echo '<br><br>';
            }

        }

    }

    public function formata_cedula()
    {

        $canidatauras = Candidaturaformacao::all();
        foreach ($canidatauras as $linha) {

            //tira caracteres errados
            $cedula_antiga = $linha->num_cedula;
            $nova_cedula = '';

            $tam = strlen($cedula_antiga);
            for ($i = 0; $i < $tam; $i++) {
                $ch = $cedula_antiga[$i];
                if ($ch == 'A' || $ch == 'O' || $ch == ' ' || $ch == '.') {

                } else {
                    $nova_cedula .= $ch;
                }
            }


            // coloca o separador de espaço
            $cedula_antiga = $nova_cedula;
            $tam = strlen($cedula_antiga);

            if ($tam > 3) {
                $nova_cedula = '';
                $cont = 0;
                for ($i = $tam - 1; $i >= 0; $i--) {

                    $ch = $cedula_antiga[$i];
                    if ($cont == 3) {
                        $nova_cedula .= ' ' . $ch;
                    } else {
                        $nova_cedula .= $ch;
                    }
                    $cont++;

                }

                //dd($nova_cedula);

                // inverte a ordem
                $cedula_antiga = $nova_cedula;
                $nova_cedula = '';
                for ($i = $tam; $i >= 0; $i--) {

                    $ch = $cedula_antiga[$i];
                    $nova_cedula .= $ch;

                }
            }

            $linha->num_cedula = $nova_cedula;
            $linha->save();
            $aluno = Aluno::where('pessoa_id', $linha->pessoa_id)->first();
            if ($aluno) {
                $aluno->num_cedula_advogado = $nova_cedula;
                $aluno->save();
            }

        }

    }

    public function avaliacao($id)
    {


        $alunos = Alunoformacao::where('turma_id', $id)->get();
        foreach ($alunos as $al) {
            for ($i = 1; $i <= 5; $i++) {

                $av = Avaliacaoaluno::create([
                    'aluno_id' => $al->aluno_id,
                    'formacao_id' => $al->formacao_id,
                    'turma_id' => $al->turma_id,
                    'disciplina_id' => $i
                ]);

            }
        }

    }

    public function higienizacao()
    {

        $alunos = Alunoformacao::whereNotNull('deleted_at')
            ->get();

        dd($alunos);

        foreach ($alunos as $al) {

            $cand = Candidaturaformacao::where('pessoa_id', $al->pessoa_id)->whereNull('deleted_at')
                ->first();
            $af = Alunoformacao::where('aluno_id', $al->id)->first();

            if ($af == null) {
                // $cand->aluno_id = $al->id;
                // $cand->save();
                echo $cand->getpessoa->nome . '<br><br>';
            }
        }

    }

    public function eliminaduplicado($id_cand)
    {


        /* $ob = new MailController();
        
        $cands = Candidaturaformacao::where('year_id', 3)->whereNull('deleted_at')->get();
        dd($cands);
        
        foreach($cands as $item){
            
            $pessoa = Pessoa::find($item->pessoa_id); 
            $res = $ob->mailRegisto($pessoa->email, $pessoa->nome);
            
            echo $pessoa->nome . '<br><br>';
        }
        
        
        
        dd('feito');
        */


        $cand = Candidaturaformacao::find($id_cand);

        $pessoa = Pessoa::find($cand->pessoa_id);
        $user = User::where('pessoa_id', $pessoa->id)->first();
        $act = Actividadesistema::where('destino', 'candidatura')->where('destino_id', $id_cand)->get();
        //dd($user);

        $cand->delete();
        $pessoa->delete();
        $user->delete();

        foreach ($act as $item) {
            $item->delete();
        }

        return 'operação realizada com sucesso ' . $id_cand;
    }




    public function colocanaturma($id_cand)
    {

        $cand = Candidaturaformacao::find($id_cand);
        $pessoa = Pessoa::find($cand->pessoa_id);

        // dd($cand);

        $aluno = null;
        $existe = Aluno::where('pessoa_id', $pessoa->id)->first();
        if ($existe) {
            $aluno = $existe;
        } else {
            $aluno = Aluno::create([
                'pessoa_id' => $cand->pessoa_id,
                'codigo' => $cand->codigo,
                'num_cedula_advogado' => $cand->num_cedula,
                'documento_bilhete' => $cand->bilhete_identidade,
                'documento_cedula' => $cand->cedula_advogado,
                'nome_patrono' => $cand->nome_patrono,
                'email_patrono' => $cand->email_patrono,
                'telefone_patrono' => $cand->telefone_patrono,
                'nome_escritorio' => $cand->nome_escritorio,
                'endereco_escritorio' => $cand->endereco_escritorio
            ]);
        }

        $cand->aluno_id = $aluno->id;
        $cand->estado = 'aprovado';
        $cand->pago = 'pago';
        $cand->turma_id = 9;
        $cand->formacao_id = 3;
        $cand->save();

        // verifica se já tinha turma
        $existe = null;
        $existe = Alunoformacao::where('aluno_id', $aluno->id)->first();
        if ($existe) {
            $existe->delete();
        }

        // verifica se já tinha notas
        $existe = null;
        $existe = Avaliacaoaluno::where('aluno_id', $aluno->id)->get();
        if ($existe != null && count($existe) > 0) {
            foreach ($existe as $item) {
                $item->delete();
            }
        }

        $aluno_formacao = Alunoformacao::create([
            'aluno_id' => $aluno->id,
            'turma_id' => $cand->turma_id,
            'formacao_id' => $cand->formacao_id
        ]);

        $user = User::where('pessoa_id', $cand->pessoa_id)->first();
        $password = $aluno->codigo . $user->id;
        $user->password = md5($password);
        $user->save();

        $turma = Turma::find($cand->turma_id);
        $formacao = Formacao::find($cand->formacao_id);

        $aluno->hash = md5($pessoa->id . $user->id . $cand->id);
        $aluno->save();

        $ob = new MailController();
        $res = $ob->mailCredenciais($pessoa->email, $pessoa->nome, $password, $turma->descricao, $formacao->nome);

        if ($res == true) {
            echo $pessoa->nome;
        }

    }

    public function referencia_alunoantigo($id_cand)
    {

        $cand = Candidaturaformacao::find($id_cand);
        $pessoa = Pessoa::find($cand->pessoa_id);

        //dd($pessoa);

        $aluno = null;
        $existe = Aluno::where('pessoa_id', $pessoa->id)->first();
        if ($existe) {
            $aluno = $existe;
        }

        $cand->estado = 'aprovado';
        $cand->pago = 'não pago';
        $cand->turma_id = 9;
        $cand->formacao_id = 3;
        $cand->save();

        // verifica se já tinha turma
        if ($aluno != null) {
            $existe = null;
            $existe = Alunoformacao::where('aluno_id', $aluno->id)->first();
            if ($existe) {
                $existe->delete();
            }

            // verifica se já tinha notas
            $existe = null;
            $existe = Avaliacaoaluno::where('aluno_id', $aluno->id)->get();
            if ($existe != null && count($existe) > 0) {
                foreach ($existe as $item) {
                    $item->delete();
                }
            }


            $aluno->delete();

        }


        $valor = $cand->getFormacao->valor_custo;
        $referencia = '';
        $ob = new ProxyPayController();
        $referencia = $ob->gerarReferencia($pessoa->telefone1, $pessoa->email, $pessoa->nome, $valor, 3);
        $cand->referencia = $referencia;
        $cand->save();

        ActividadesistemaController::inserir(null, 'Enviou a referência de pagamento por SMS', 'Sistema', 'candidatura', $cand->id);

        echo $pessoa->nome;

    }

    public function emailconfirmacao()
    {

        $result = DB::connection('mysql')->select("select * from receberemail");
        foreach ($result as $linha) {

            $cand = Candidaturaformacao::find($linha->id);
            $pessoa = Pessoa::find($cand->pessoa_id);

            if ($pessoa) {
                $ob = new MailController();
                $res = $ob->mailConfirmacao($pessoa->email, $pessoa->nome);

                if ($res == true) {
                    echo $pessoa->nome . '<br><br>';
                }
            }
            else{
                echo 'não tem pessoa ' . $linha->id . '<br><br>';
            }
        }


    }


}
