<?php

namespace App\Http\Controllers;

use App\Lib\Repositories\CandidatoRepository;
use App\Models\Enoaa\Ano;
use App\Models\Fio\Aluno;
use App\Models\Fio\Alunoformacao;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Enoaa\Pessoa;
use App\Models\Fio\Formacao;
use App\Models\Fio\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \PDF;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ob = new CandidatoRepository();
        return $ob->cadastrarCandidato($request);
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
    public function update(Request $request, $id)
    {
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

    public function updateCandidatura(Request $request)
    {

        $candidatura = Candidaturaformacao::find($request->candidatura_id);
        $pessoa = Pessoa::find($request->pessoa_id);
       
        $ano_activo = Ano::find($candidatura->year_id);
        $formacao = Formacao::find($candidatura->formacao_id);
        $turma = Turma::find($candidatura->turma_id);
        $codigo = $candidatura->codigo;

        $valida = $this->validaDados($request->num_documento2, $request->email, $request->tel1, $request->tel2, $pessoa->id);
        if ($valida == 'true') {

             //cédula do advogado
             try {
                if ($request->hasFile('cedula_advogado') && $request->file('cedula_advogado')->isValid()) {
                    $cedula_advogado = $request->cedula_advogado->store('candidaturas/' . $formacao->getTipoformacao->codigo . '/' . $ano_activo->descricao . '/' . $codigo);
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
                    $bilhete_identidade = $request->bilhete_identidade->store('candidaturas/' . $formacao->getTipoformacao->codigo . '/' . $ano_activo->descricao . '/' . $codigo);
                    // $cedula_advogado = $request->doc_bi->storeAs('candidaturas/' . $form_inscrito->codigo . '/' . $ano_activo->descricao . '/' . $codigo , 'doc_identificação_' . $candidato->id . '.pdf');
                    $candidatura->bilhete_identidade = $bilhete_identidade;
                    $candidatura->save();
                }
            } catch (Throwable $error) {
                // throw new Exception($error);
            }

            // verifica se a candidatura está suspensa
            if($candidatura->estado == 'suspenso'){
                $candidatura->estado = 'pendente';
                $candidatura->pintar = 'Não';
                $candidatura->pago = 'não pago';
                $candidatura->save();
            }

            // actualiza dados da pessoa
            $encoding = mb_internal_encoding();
            $pessoa->nome = mb_strtoupper($request->nome_completo, $encoding);
            $pessoa->genero = $request->genero;
            $pessoa->email = $request->email;
            $pessoa->telefone1 = $request->tel1;
            $pessoa->telefone2 = $request->tel2;
            $pessoa->num_documento = $request->num_documento2;
            $pessoa->save();

            // actualiza dados da canditura
            $candidatura->num_cedula = $request->num_cedula;
            $candidatura->nome_patrono = $request->nome_patrono;
            $candidatura->email_patrono = $request->email_patrono;
            $candidatura->telefone_patrono = $request->telefone_patrono;
            $candidatura->nome_escritorio = $request->nome_escritorio;
            $candidatura->endereco_escritorio = $request->endereco_escritorio;
            $candidatura->save();

            // actualiza dados do aluno, se existe
            $aluno = Aluno::where('pessoa_id', $pessoa->id)->first();
            if($aluno){
                $aluno->num_cedula_advogado = $request->num_cedula;
                $aluno->nome_patrono = $request->nome_patrono;
                $aluno->email_patrono = $request->email_patrono;
                $aluno->telefone_patrono = $request->telefone_patrono;
                $aluno->nome_escritorio = $request->nome_escritorio;
                $aluno->endereco_escritorio = $request->endereco_escritorio;
                $aluno->documento_cedula = $candidatura->cedula_advogado;
                $aluno->documento_bilhete = $candidatura->bilhete_identidade;
                $aluno->save();
            }

            // regista actividade do sistema
            ActividadesistemaController::inserir(Auth::id(), 'Actualizou as suas informações no sistema', 'Candidato', 'candidatura', $candidatura->id);

            return 'sucesso';

        } else {
            return $valida;
        }
    }

    public function validaDados($documento, $email, $tel, $tel2, $idpessoa)
    {

        $result = Pessoa::where('email', $email)->where('id', '!=', $idpessoa)->first();
        if ($result != null) {
            return 'email';
        } else {
            $result = Pessoa::where('telefone1', $tel)->where('id', '!=', $idpessoa)->first();
            if ($result != null) {
                return 'telefone1';
            } else {
                $result = Pessoa::where('telefone2', $tel)->where('id', '!=', $idpessoa)->first();
                if ($result != null) {
                    return 'telefone1';
                } else {
                    $result = Pessoa::where('telefone1', $tel2)->where('id', '!=', $idpessoa)->first();
                    if ($result != null) {
                        return 'telefone2';
                    } else {
                        $result = Pessoa::where('telefone2', $tel2)->where('id', '!=', $idpessoa)->first();
                        if ($result != null) {
                            return 'telefone2';
                        }
                        else{
                            $result = Pessoa::where('num_documento', $documento)
                            ->where('id', '!=', $idpessoa)->first();
                
                            if($result != null){
                                return 'documento';
                            }
                        }
                    }
                }
            }
        }
        return 'true';
    }

    public function declaracao($id_aluno)
    {

        $aluno = Aluno::find($id_aluno);
        $aluno_formacao = Alunoformacao::where('aluno_id', $aluno->id)->first();

        $nome = $aluno->getPessoa->nome;
        $cedula = $aluno->num_cedula_advogado;
        $num_bilhete = $aluno->getPessoa->num_documento;
        $formacao = $aluno_formacao->getFormacao->nome;
        $turma = $aluno_formacao->getTurma->descricao;

        $cripto = md5($aluno->hash . $nome . $cedula . $num_bilhete . $aluno_formacao->turma_id . $aluno_formacao->id);
        $cripto_min = $aluno->hash[0] . $cripto[0] . $cripto[12] . $cripto[22] . $cripto[29];

        $hoje = date("Y-m-d h:i:s");

        $meses = [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ];

        $data_emissao[0] = date("d");
        $data_emissao[1] = $meses[date("m")];
        $data_emissao[2] = date("Y");

        $qrcode = "
        NOME => $nome;
        CÉDULA => $cedula;
        Nº IDENT => $num_bilhete;
        FORMAÇÃO => $formacao;
        TURMA => $turma;
        TOKEN-HASH => $cripto_min;
        DATA DE EMISSÃO => $hoje
        ";

        $pdf = Pdf::loadView('documents-pdf.nova-declaracao', [
            'nome' => $nome,
            'cedula' => $cedula,
            'qrcode' => $qrcode,
            'token' => $cripto_min,
            'data' => $data_emissao
        ]);

        return $pdf->stream();

        // guarda o pdf
        // $path = Storage::put('candidatos/' . $this->ano->descricao . '/' . $this->candidatura->codigo . '/' . 'ficha_candidato_' . $this->candidato->id . '.pdf', $pdf->output());
        // Storage::put($path, $pdf->output());


    }
}
