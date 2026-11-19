<?php

namespace App\Http\Controllers;

use App\Models\Fio\Aluno;
use App\Models\Fio\Alunoformacao;
use App\Models\Fio\Atribuicaoalunoprova;
use App\Models\Fio\Avaliacaoaluno;
use App\Models\Fio\Prova;
use App\Models\Fio\Respostaprova;
use Illuminate\Http\Request;

class ProvaController extends Controller
{
    public function gettimeexam($id_prova)
    {

        $prova = Prova::find($id_prova());

        date_default_timezone_set("Africa/Luanda");
        $hora_hoje = date("H:i:s");

        if (strtotime($hora_hoje) < strtotime($prova->hora_fim)) {
            return 'false';
        } else if (strtotime($hora_hoje) >= strtotime($prova->hora_fim)) {
            return 'true';
        }

    }

    public function finalizar_prova($id_prova)
    {

        $prova = Prova::find($id_prova);

        // pega todos que fizeram a prova e não finalizaram
        $alunos = Atribuicaoalunoprova::where('prova_id', $prova->id)
            ->where('estado', 'realizando')
            ->get();

        // dd($alunos);

        foreach ($alunos as $ap) {

            $ap->estado = 'realizada';
            $ap->save();

            $aluno_id = $ap->aluno_id;
            $disciplina_id = $ap->disciplina_id;

            // pega as respostas do aluno
            $respostas = Respostaprova::where('prova_id', $prova->id)
                ->where('aluno_id', $aluno_id)
                ->where('disciplina_id', $disciplina_id)
                ->get();

            // dd($respostas);

            $nota = 0;
            foreach ($respostas as $resp) {
                $nota = $nota + $resp->cotacao;
            }


            // verifica se já está na tabela de avaliação
            $aluno_formacao = Alunoformacao::where('aluno_id', $aluno_id)->first();
            $formacao_id = $aluno_formacao->formacao_id;
            $turma_id = $aluno_formacao->turma_id;

            $existe = Avaliacaoaluno::where('aluno_id', $aluno_id)
                ->where('turma_id', $turma_id)
                ->where('disciplina_id', $disciplina_id)
                ->first();

            if ($existe) {
                $existe->nota1 = $nota;
                $existe->save();
            } else {

                // insere na tabela avaliação do aluno
                $ava = Avaliacaoaluno::create([
                    'aluno_id' => $aluno_id,
                    'formacao_id' => $formacao_id,
                    'turma_id' => $turma_id,
                    'disciplina_id' => $disciplina_id,
                    'nota1' => $nota
                ]);
            }

            $aluno = Aluno::find($aluno_id);
            echo $aluno->getpessoa->nome . ' terminou a prova com nota ' . $nota . '<br>';

        }

        // pega todos que não fizeram a prova e coloca como não realizada
        $alunos = Atribuicaoalunoprova::where('prova_id', $prova->id)
            ->where('estado', 'atribuido')
            ->get();

        foreach ($alunos as $ap) {
            $ap->estado = 'nao realizada';
            $ap->save();
            $aluno = Aluno::find($ap->aluno_id);
            echo $aluno->getpessoa->nome . ' não realizou a prova <br>';
        }

        $prova->ativo = 'Não';
        $prova->save();

    }
}
