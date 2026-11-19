<?php

namespace App\Http\Controllers;

use App\Exports\Listaturmaexport;
use App\Models\Fio\Aluno;
use App\Models\Fio\Alunoformacao;
use App\Models\Fio\Avaliacaoaluno;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Fio\Disciplina;
use App\Models\Fio\Emissaodeclaracao;
use App\Models\Fio\Historicodeclaracao;
use App\Models\Fio\Historiconotas;
use App\Models\Fio\Perguntaprova;
use App\Models\Fio\Professor;
use App\Models\Fio\Professorformacao;
use App\Models\Fio\Prova;
use App\Models\Fio\Sistemaavaliacao;
use App\Models\Fio\Turma;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use \PDF;

class FormacaoController extends Controller
{
    public function getTurmasByFormacao($id)
    {
        $turmas = Turma::where('formacao_id', $id)->get();
        return $turmas;
    }

    public function getVagasByTurma($id, $prov_formacao, $prov_residencia)
    {

        $turma = Turma::find($id);
        $capacidade = $turma->capacidade;
        $modalidade = $turma->modalidade;

        $inscricoes = Candidaturaformacao::where('turma_id', $id)->count();
        $total = ($capacidade - $inscricoes);

        if ($prov_formacao == 11 && $prov_residencia == 11 && $modalidade == 'online') {
            return 0;
        } else if ($prov_formacao == 11 && $prov_residencia == 11 && $modalidade == 'presencial') {
            return $total <= 0 ? 0 : $total;
        } else if ($prov_formacao == 11 && $prov_residencia != 11 && $modalidade == 'presencial') {
            return $total <= 0 ? 0 : $total;
        } else if ($prov_formacao != 11 && $prov_residencia == 11 && $modalidade == 'online') {
            return $total <= 0 ? 0 : $total;
        } else if ($prov_formacao != 11 && $prov_residencia != 11 && $modalidade == 'presencial') {
            return $total <= 0 ? 0 : $total;
        } else if ($prov_formacao != 11 && $prov_residencia != 11 && $modalidade == 'online') {
            return $total <= 0 ? 0 : $total;
        }

    }

    public function enviar_referencias(Request $request)
    {

        $turma_id = $request->input('turma_select');
        $turma = Turma::find($turma_id);
        $formacao = $turma->getFormacao;

        $candidaturas = Candidaturaformacao::where('turma_id', $turma_id)
            ->where('estado', 'pendente')
            ->where('pago', 'não pago')
            ->get();

        $valor = $formacao->valor_custo;
        $referencia = '';
        $ob = new ProxyPayController();

        // pega a data de hoje
        $today = Carbon::today();
        $data_expiracao = $today->addDays(3);
        $data_expiracao = substr($data_expiracao, 0, 10);

        foreach ($candidaturas as $item) {

            set_time_limit(0);

            $referencia = $ob->gerarReferencia($item->getPessoa->telefone1, $item->getPessoa->email, $item->getPessoa->nome, $valor, 3);
            $item->estado = 'aprovado';
            $item->pintar = 'Não';
            $item->referencia = $referencia;
            $item->validade_referencia = $data_expiracao;
            $item->pago = 'não pago';
            $item->save();

            // gerar historico
            ActividadesistemaController::inserir(Auth::id(), 'Aprovou a candidatura', 'CEF', 'candidatura', $item->id);

            // regista actividade do sistema
            ActividadesistemaController::inserir(null, 'Enviou a referência de pagamento por SMS', 'Sistema', 'candidatura', $item->id);

        }

        return 'sucesso';

    }

    public function exportarListaTurma($id_turma)
    {

        $turma = Turma::find($id_turma);
        $nome_file = 'lista_turma_' . $turma->descricao;
        return Excel::download(new Listaturmaexport($id_turma), $nome_file . '.xlsx');

    }

    public function declaracao($hash_candidatura, $hash_aluno)
    {

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


        $candidatura = Candidaturaformacao::where('hash', $hash_candidatura)->first();
        $aluno = Aluno::where('hash', $hash_aluno)->first();
        $aluno_formacao = Alunoformacao::where('aluno_id', $aluno->id)
            ->where('turma_id', $candidatura->turma_id)->first();

        $nome = $aluno->getPessoa->nome;
        $cedula = $aluno->num_cedula_advogado;
        $num_bilhete = $aluno->getPessoa->num_documento;
        $formacao = $aluno_formacao->getFormacao->nome;
        $turma = $aluno_formacao->getTurma->descricao;
        $ciclo = $aluno_formacao->getFormacao->ciclo;

        // verifica se a declaração já foi emitida antes
        $verifica = Emissaodeclaracao::where('aluno_id', $aluno->id)
            ->where('turma_id', $aluno_formacao->turma_id)
            ->where('formacao_id', $aluno_formacao->formacao_id)
            ->first();


        $hoje = '';
        $cripto_min = '';

        if ($verifica) {

            $cripto_min = $verifica->min_hash;
            $hoje = $verifica->created_at;

            $hist = Historicodeclaracao::create([
                'declaracao_id' => $verifica->id,
                'user_id' => Auth::id()
            ]);

        } else {

            $emi_dec = Emissaodeclaracao::create([
                'turma_id' => $aluno_formacao->turma_id,
                'formacao_id' => $aluno_formacao->formacao_id,
                'aluno_id' => $aluno->id,
                'user_id' => Auth::id()
            ]);

            $hoje = $emi_dec->created_at;
            $ano_formacao = $aluno_formacao->getFormacao->getAno->descricao;
            $string_hash = $hoje . $ano_formacao . $aluno->hash . $hash_candidatura . $nome . $cedula . $num_bilhete . $formacao . $turma . $aluno_formacao->id;
            $cripto = md5($string_hash);
            $cripto_min = $aluno->hash[0] . $cripto[0] . $cripto[11] . $cripto[21] . $cripto[28] . $cripto[30];

            $emi_dec->codigo = 'FIODEC/' . $ano_formacao . '/' . $emi_dec->id;
            $emi_dec->full_hash = $cripto;
            $emi_dec->min_hash = $cripto_min;
            $emi_dec->save();

            // gerar historico
            ActividadesistemaController::inserir(Auth::id(), 'Emitiu a declaração da formação inicial obrigatória', 'Candidato', 'candidatura', $candidatura->id);
            $hist = Historicodeclaracao::create([
                'declaracao_id' => $emi_dec->id,
                'user_id' => Auth::id()
            ]);

        }

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
            'ciclo' => $ciclo,
            'data' => $data_emissao
        ]);

        return $pdf->stream();

    }

    public function declaracao_antigo($hash_aluno)
    {

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


        $aluno = Aluno::where('hash', $hash_aluno)->first();

        //dd( $aluno);

        $nome = $aluno->getPessoa->nome;
        $cedula = $aluno->num_cedula_advogado;
        $num_bilhete = $aluno->getPessoa->num_documento;
        $formacao = $aluno->formacao;
        $turma = $aluno->turma;
        $ciclo = $aluno->ciclo . 'º';
        $ano = $aluno->ano;

        // verifica se a declaração já foi emitida antes
        $verifica = Emissaodeclaracao::where('aluno_id', $aluno->id)
            ->first();


        $hoje = '';
        $cripto_min = '';

        if ($verifica) {

            $cripto_min = $verifica->min_hash;
            $hoje = $verifica->created_at;

            $hist = Historicodeclaracao::create([
                'declaracao_id' => $verifica->id,
                'user_id' => Auth::id()
            ]);

        } else {

            $emi_dec = Emissaodeclaracao::create([
                'aluno_id' => $aluno->id,
                'user_id' => Auth::id()
            ]);

            $hoje = $emi_dec->created_at;
            $string_hash = $hoje . $aluno->hash . $nome . $cedula . $ano . $num_bilhete . $formacao . $turma . $aluno->id;
            $cripto = md5($string_hash);
            $cripto_min = $aluno->hash[0] . $cripto[0] . $cripto[11] . $cripto[21] . $cripto[28] . $cripto[30];

            $emi_dec->codigo = 'FIODEC/' . $ano . '/' . $emi_dec->id;
            $emi_dec->full_hash = $cripto;
            $emi_dec->min_hash = $cripto_min;
            $emi_dec->save();

            // gerar historico
            ActividadesistemaController::inserir(Auth::id(), 'Emitiu a declaração da formação inicial obrigatória', 'CEF', 'conta', Auth::id());
            $hist = Historicodeclaracao::create([
                'declaracao_id' => $emi_dec->id,
                'user_id' => Auth::id()
            ]);

        }

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
            'ciclo' => $ciclo,
            'data' => $data_emissao
        ]);

        return $pdf->stream();

    }

    public function certificado()
    {

        $formandos = DB::select("select * from certificados limit 4");
        // dd($formandos);

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


        $pdf = Pdf::loadView('documents-pdf.certificado', [
            'formandos' => $formandos,
            'data' => $data_emissao
        ]);

        // return $pdf->stream();
        return $pdf->download('certificados_formacao.pdf');


    }
    public function mini_pauta($disciplina_id, $turma_id, $professor_id)
    {

        $disciplina = Disciplina::find($disciplina_id);
        $turma = Turma::find($turma_id);
        $professor = Professor::find($professor_id);

        $alunos_turma = Alunoformacao::join('aluno', 'alunos_formacao.aluno_id', 'aluno.id')
            ->join('pessoas', 'pessoas.id', 'aluno.pessoa_id')
            ->where('alunos_formacao.turma_id', $turma->id)
            ->select('alunos_formacao.*')
            ->orderBy('pessoas.nome', 'asc')
            ->get();

        $avaliacoes = Avaliacaoaluno::join('aluno', 'avaliacao_aluno.aluno_id', 'aluno.id')
            ->join('pessoas', 'pessoas.id', 'aluno.pessoa_id')
            ->where('avaliacao_aluno.turma_id', $turma->id)
            ->where('avaliacao_aluno.disciplina_id', $disciplina_id)
            ->select('avaliacao_aluno.*')
            ->orderBy('pessoas.nome', 'asc')
            ->get();

        $aprovados = Avaliacaoaluno::where('turma_id', $turma_id)
            ->where('disciplina_id', $disciplina->id)
            ->where('notafinal', '>=', 9.5)->count();
        $reprovados = Avaliacaoaluno::where('turma_id', $turma_id)
            ->where('disciplina_id', $disciplina->id)
            ->where('notafinal', '<', 9.5)->count();

        $reprovados += Avaliacaoaluno::where('turma_id', $turma_id)
            ->where('disciplina_id', $disciplina->id)
            ->whereNull('notafinal')->count();

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


        $pdf = Pdf::loadView('documents-pdf.mini-pauta', [
            'turma' => $turma,
            'disciplina' => $disciplina,
            'professor' => $professor,
            'alunos' => $alunos_turma,
            'avaliacoes' => $avaliacoes,
            'aprovados' => $aprovados,
            'reprovados' => $reprovados,
            'data' => $data_emissao
        ]);

        return $pdf->stream();

    }

    public function mini_pauta_turma($turma_id)
    {

        $turma = Turma::find($turma_id);

        $alunos = Alunoformacao::join('aluno', 'alunos_formacao.aluno_id', 'aluno.id')
            ->join('pessoas', 'pessoas.id', 'aluno.pessoa_id')
            ->where('alunos_formacao.turma_id', $turma->id)
            ->select('alunos_formacao.*')
            ->orderBy('pessoas.nome', 'asc')
            ->get();

        $aprovados = 0;
        $reprovados = 0;

        $linhas_result = array();
        foreach ($alunos as $item) {

            $linha = [];
            $linha['codigo'] = $item->getAluno->codigo;
            $linha['nome'] = $item->getAluno->getPessoa->nome;
            $avaliacao = Avaliacaoaluno::where('turma_id', $turma->id)
                ->where('aluno_id', $item->aluno_id)
                ->get();

            $cont = 1;
            for ($cont = 1; $cont <= 5; $cont++) {
                $linha[$cont] = 0;
            }

            $somatorio = 0;
            foreach ($avaliacao as $av) {
                $linha[$av->disciplina_id] = $av->notafinal;
                $somatorio += $av->notafinal == null ? 0 : $av->notafinal;
            }


            $linha['media'] = ($somatorio) / 5;
            if ($linha['media'] >= 9.5) {
                $aprovados++;
            } else {
                $reprovados++;
            }

            // dd($linha);
            array_push($linhas_result, $linha);

        }

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


        $pdf = Pdf::loadView('documents-pdf.mini-pauta-turma', [
            'turma' => $turma,
            'avaliacoes' => $linhas_result,
            'aprovados' => $aprovados,
            'reprovados' => $reprovados,
            'data' => $data_emissao
        ]);

        return $pdf->stream();

    }

    public function enunciado_prova($prova_id)
    {

        $prova = Prova::find($prova_id);
        $perguntas = Perguntaprova::where('prova_id', $prova_id)->get();

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


        $pdf = Pdf::loadView('documents-pdf.enunciado-prova', [
            'prova' => $prova,
            'perguntas' => $perguntas
        ]);

        return $pdf->stream();

    }

    public function cadastrarPergunta(Request $request)
    {
        //dd($request->all());
        $desc_pergunta = $request->input('desc_pergunta');
        $opcao_a = $request->input('opcao_a');
        $opcao_b = $request->input('opcao_b');
        $opcao_c = $request->input('opcao_c');
        $opcao_d = $request->input('opcao_d');
        $opcao_e = $request->input('opcao_e');
        $resposta = $request->input('resposta');
        $numero = $request->input('numero');
        $pontuacao = $request->input('pontuacao');
        $prova_id = $request->input('prova_id');

        $nova_pergunta = Perguntaprova::create([
            'corpo_pergunta' => $desc_pergunta,
            'opcao1' => $opcao_a,
            'prova_id' => $prova_id,
            'opcao2' => $opcao_b,
            'opcao3' => $opcao_c,
            'opcao4' => $opcao_d,
            'opcao5' => $opcao_e,
            'resposta_opcao' => $resposta,
            'numero' => $numero,
            'cotacao' => $pontuacao,
            "user_id" => Auth::id()
        ]);

        return response()->json(['status' => 'sucesso', 'mensagem' => 'Pergunta cadastrada com sucesso!']);
    }

    public function distribuir_alunos()
    {

        // pega todos formandos da turma A (Mediateca de Luanda)
        $formandos = Candidaturaformacao::where('turma_id', 14)
            ->where('pago', 'pago')
            ->whereNotNull('aluno_id')
            ->orderBy('id', 'asc')
            ->get();

        // dd($formandos);

        $contador = 1;

        // inserir os formandos restantes na turma D
        foreach ($formandos as $cand) {

            set_time_limit(0);

            $conta = Alunoformacao::where('turma_id', 18)->count();

            if ($conta < 100) {

                $aluno_formacao = Alunoformacao::where('aluno_id', $cand->aluno_id)->first();
                $candidatura = Candidaturaformacao::where('aluno_id', $cand->aluno_id)->first();

                $aluno_formacao->turma_id = 18;
                $aluno_formacao->formacao_id = 5;
                $aluno_formacao->save();
                $candidatura->turma_id = 18;
                $candidatura->formacao_id = 5;
                $candidatura->year_id = 4;
                $candidatura->save();

                echo $contador . ' - ' . $aluno_formacao->getAluno->getPessoa->nome . ' Turma D <br>';

            }

            $contador++;
        }

        dd('Formandos restantes inseridos na turma D');

        // ids de alunos para incluir na Mediateca de Luanda
        $vetor_excecao = [2349, 2208, 2514, 2344, 2453, 2255, 2535];

        $contador = 1;

        // inserir a lista de exceção na turma da Mediateca
        foreach ($vetor_excecao as $id_aluno) {

            $aluno_formacao = Alunoformacao::where('aluno_id', $id_aluno)->first();
            $candidatura = Candidaturaformacao::where('aluno_id', $id_aluno)->first();

            $aluno_formacao->turma_id = 15;
            $aluno_formacao->formacao_id = 5;
            $aluno_formacao->save();
            $candidatura->turma_id = 15;
            $candidatura->formacao_id = 5;
            $candidatura->year_id = 4;
            $candidatura->save();

            echo $contador . ' - ' . $aluno_formacao->getAluno->getPessoa->nome . ' Turma A (Mediateca de Luanda) <br>';
            $contador++;
        }


        $formandos = Candidaturaformacao::where('turma_id', 14)
            ->where('pago', 'pago')
            ->whereNotNull('aluno_id')
            ->orderBy('id', 'asc')
            ->get();


        // inserir mais 97 na turma da Mediateca
        foreach ($formandos as $cand) {

            set_time_limit(0);
            $conta = Alunoformacao::where('turma_id', 15)->count();

            if ($conta < 100) {

                if (in_array($cand->aluno_id, $vetor_excecao) == false) {

                    $aluno_formacao = Alunoformacao::where('aluno_id', $cand->aluno_id)->first();
                    $candidatura = Candidaturaformacao::where('aluno_id', $cand->aluno_id)->first();

                    $aluno_formacao->turma_id = 15;
                    $aluno_formacao->formacao_id = 5;
                    $aluno_formacao->save();
                    $candidatura->turma_id = 15;
                    $candidatura->formacao_id = 5;
                    $candidatura->year_id = 4;
                    $candidatura->save();

                    echo $contador . ' - ' . $aluno_formacao->getAluno->getPessoa->nome . ' Turma A (Mediateca de Luanda) <br>';
                }
            }

            $contador++;
        }


        // distribuir os restantes alunos entre as turmas B e C (Óscar Ribas)

        $formandos = Candidaturaformacao::where('turma_id', 14)
            ->where('pago', 'pago')
            ->whereNotNull('aluno_id')
            ->orderBy('id', 'asc')
            ->get();

        $contador = 101;
        foreach ($formandos as $cand) {

            set_time_limit(0);

            $aluno_formacao = Alunoformacao::where('aluno_id', $cand->aluno_id)->first();
            $candidatura = Candidaturaformacao::where('aluno_id', $cand->aluno_id)->first();
            $pessoa = $cand->getPessoa;

            if (in_array($cand->aluno_id, $vetor_excecao) == false) {

                $conta1 = Alunoformacao::where('turma_id', 16)->count();
                $conta2 = Alunoformacao::where('turma_id', 17)->count();

                if ($conta1 < 100 && $contador % 2 == 0) {

                    $turma_id = 16;
                    $aluno_formacao->turma_id = $turma_id;
                    $aluno_formacao->formacao_id = 5;
                    $aluno_formacao->save();

                    $candidatura->turma_id = $turma_id;
                    $candidatura->formacao_id = 5;
                    $candidatura->year_id = 4;
                    $candidatura->save();

                    echo $contador . ' - ' . $pessoa->nome . ' Turma B (Óscar Ribas) <br>';

                } else if ($conta2 < 100 && $contador % 2 == 1) {

                    $turma_id = 17;
                    $aluno_formacao->turma_id = $turma_id;
                    $aluno_formacao->formacao_id = 5;
                    $aluno_formacao->save();

                    $candidatura->turma_id = $turma_id;
                    $candidatura->formacao_id = 5;
                    $candidatura->year_id = 4;
                    $candidatura->save();

                    echo $contador . ' - ' . $pessoa->nome . ' Turma C (Óscar Ribas) <br>';
                } else {
                    echo $contador . ' - ' . $pessoa->nome . ' Turma Presencial <br>';
                }

            } else {
                echo $contador . ' - ' . $pessoa->nome . ' Turma A (Mediateca de Luanda) <br>';
            }

            $contador++;

        }
    }

    public function smsWhatsapp($id_turma)
    {

        $formandos = Alunoformacao::where('turma_id', $id_turma)->get();
        // dd($formandos);

        $ob = new OmbalaController();
        $cont = 1;

        foreach ($formandos as $item) {

            set_time_limit(0);

            if ($cont >= 66) {
                $telefone = $item->getAluno->getPessoa->telefone1;
                $nome = $item->getAluno->getPessoa->nome;
                // dd($nome);
                $mensagem = "Caríssimo(a), fará parte da Turma A (Mediateca de Luanda). Segue o link de acesso ao grupo da turma: https://chat.whatsapp.com/I5lYB5elgSX9DGQYDV0MvH?mode=gi_t";
                $ob->enviarMensagem($telefone, $mensagem);

                echo 'Mensagem enviada para ' . $nome . ' - ' . $telefone . '<br>';
            }

            $cont++;

        }


    }

    public function enviarEmail($id_turma)
    {

        $formandos = Alunoformacao::where('turma_id', $id_turma)->get();
        // dd($formandos);

        $ob = new MailController();
        $cont = 1;

        foreach ($formandos as $item) {

            set_time_limit(0);

            $email = $item->getAluno->getPessoa->email;
            $nome = $item->getAluno->getPessoa->nome;
            // dd($nome);
            $ob->aberturaTurmaD($email, $nome);

            echo $cont . ') Email enviado para ' . $nome . ' - ' . $email . '<br>';
            $cont++;

        }

    }

    public function finalizar_prova($id_turma, $id_disciplina)
    {

        $formandos = Avaliacaoaluno::where('turma_id', $id_turma)->where('disciplina_id', $id_disciplina)->get();

        // dd($formandos);

        foreach ($formandos as $linha) {

            set_time_limit(0);

            if ($linha->nota2 != null) {
                $linha->nota1 = $linha->nota2;
                $linha->notafinal = $linha->nota2;
                $linha->save();
            }
        }

    }

    public function atualizar_nota(Request $request)
    {

        if (Auth::user()->permission_id != 1 && Auth::user()->permission_id != 6) {
            return response()->json(['status' => 'erro', 'mensagem' => 'Não tem permissão para alterar notas!']);
        }

        $professor = Professor::where('pessoa_id', Auth::user()->pessoa_id)->first();
        $prof_formacao = Professorformacao::where('professor_id', $professor->id)->where('turma_id', $request->turmaid)->first();
        $disciplina_id = $prof_formacao->disciplina_id;

        $av = Avaliacaoaluno::where('aluno_id', $request->idaluno)
            ->where('turma_id', $request->turmaid)
            ->where('disciplina_id', $disciplina_id)->first();

        $old_nota1 = $av->nota1;
        $old_nota2 = $av->nota2;
        $oldnotafinal = $av->notafinal;

        // verifica se tem configuração de notas para a disciplina
        $existe = Sistemaavaliacao::where('disciplina_id', $disciplina_id)
            ->where('turma_id', $request->turmaid)
            ->where('professor_id', $professor->id)
            ->first();

        $nota1 = $request->nota1edit;
        $nota2 = $request->nota2edit;

        if ($existe) {

            if ($existe->qtd_notas_lancar == 1) {
                $av->nota1 = $request->nota1edit;
                $av->notafinal = $request->nota1edit;
                $av->save();
            } else if ($existe->qtd_notas_lancar == 2) {
                if ($existe->criterio_resultado_final == 'soma') {

                    $av->nota1 = $nota1;
                    $av->nota2 = $nota2;
                    $av->notafinal = ($nota1 + $nota2);
                    if (($nota1 + $nota2) > 20) {
                        return response()->json(['status' => 'erro', 'mensagem' => 'O resultado final não pode exceder 20!']);
                    }
                    $av->save();

                } else if ($existe->criterio_resultado_final == 'media') {
                    $av->nota1 = $nota1;
                    $av->nota2 = $nota2;
                    $av->notafinal = ($nota1 + $nota2) / 2;
                    if (($nota1 + $nota2) / 2 > 20) {
                        return response()->json(['status' => 'erro', 'mensagem' => 'O resultado final não pode exceder 20!']);
                    }
                    $av->save();
                } else {

                    $nota1 = $nota1 * ($existe->percent_nota1 / 100);
                    $nota2 = $nota2 * ($existe->percent_nota2 / 100);

                    $av->nota1 = $nota1;
                    $av->nota2 = $nota2;
                    $av->notafinal = ($nota1 + $nota2);
                    if (($nota1 + $nota2) > 20) {
                        return response()->json(['status' => 'erro', 'mensagem' => 'O resultado final não pode exceder 20!']);
                    }
                    $av->save();
                }

            }

        } else {
            // customização para multidisciplinares 
            if ($disciplina_id == 4) {

                $av->nota1 = $nota1;
                $av->nota2 = $nota2;
                $av->notafinal = ($nota1 + $nota2);
                if (($nota1 + $nota2) > 20) {
                    return response()->json(['status' => 'erro', 'mensagem' => 'O resultado final não pode exceder 20!']);
                }
                $av->save();

                // customização para processo civil
            } else if ($disciplina_id == 2) {

                $res = ($nota1) + ($nota2 * 0.45);
                if ($res > 20) {
                    return response()->json(['status' => 'erro', 'mensagem' => 'O resultado final não pode exceder 20!']);
                }

                $av->nota1 = $nota1;
                $av->nota2 = $nota2;
                $av->notafinal = $res;
                $av->save();

            } else {
                $av->nota1 = $nota1;
                $av->nota2 = $nota2;
                $av->notafinal = ($nota1 + $nota2) / 2;
                if (($nota1 + $nota2) / 2 > 20) {
                    return response()->json(['status' => 'erro', 'mensagem' => 'O resultado final não pode exceder 20!']);
                }
                $av->save();
            }
        }

        $hist = Historiconotas::create([
            'aluno_id' => $request->idaluno,
            'turma_id' => $request->turmaid,
            'professor_id' => $professor->id,
            'disciplina_id' => $disciplina_id,
            'user_id' => Auth::id(),
            'oldnota1' => $old_nota1,
            'oldnota2' => $old_nota2,
            'oldnotafinal' => $oldnotafinal,
            'newnota1' => $av->nota1,
            'newnota2' => $av->nota2,
            'newnotafinal' => $av->notafinal,
            'observacao' => $request->observacao
        ]);

        return response()->json(['status' => 'sucesso', 'mensagem' => 'Nota atualizada com sucesso!']);

    }

}