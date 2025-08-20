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
use App\Models\Fio\Professor;
use App\Models\Fio\Turma;
use DB;
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

    public function getVagasByTurma($id)
    {

        $turma = Turma::find($id);
        $capacidade = $turma->capacidade;

        $inscricoes = Candidaturaformacao::where('turma_id', $id)->count();

        $total = ($capacidade - $inscricoes);

        return $total <= 0 ? 0 : $total;

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
        $ciclo = $aluno_formacao->formacao_id == 1 ? '32º' : '33º';

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
}
