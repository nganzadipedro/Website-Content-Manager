<?php

namespace App\Http\Livewire\Candidato;

use App\Models\Fio\Aluno;
use App\Models\Fio\Alunoformacao;
use App\Models\Fio\Atribuicaoalunoprova;
use App\Models\Fio\Avaliacaoaluno;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Fio\Prova;
use App\Models\Fio\Respostaprova;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Provas extends Component
{
    public $user;
    public $aluno;
    public $aluno_formacao;
    public $pessoa;
    public $candidatura;
    public $provas = array();
    public function render()
    {
        $this->user = User::find(Auth::id());
        if ($this->user->permission_id == 5) {

            $this->pessoa = $this->user->getPessoa;
            $aluno = Aluno::where('pessoa_id', $this->pessoa->id)->first();
            $this->candidatura = Candidaturaformacao::where('pessoa_id', $this->pessoa->id)->first();

            if ($aluno) {
                $this->aluno = $aluno;
                $this->provas = Atribuicaoalunoprova::where('aluno_id', $this->aluno->id)->get();
            }
        }

        return view('dashboard.candidato.provas')->extends('layouts.app')->section('conteudo');
    }

    public function verifica_data($id)
    {

        date_default_timezone_set("Africa/Luanda");
        $data_hoje = date("Y-m-d");
        $hora_hoje = date("H:i:s");
        $prova = Prova::find($id);

        if ($prova->ativo == 'Sim') {
            if ($data_hoje != $prova->data_prova) {
                return 'erro_data';
            } else {
                if (strtotime($hora_hoje) < strtotime($prova->hora_inicio)) {
                    return 'erro_hora';
                } else if (strtotime($hora_hoje) >= strtotime($prova->hora_fim)) {
                    return 'erro_hora';
                } else if (strtotime($hora_hoje) >= strtotime($prova->hora_inicio)) {

                    // verifica se o aluno já fez a prova
                    $ap = Atribuicaoalunoprova::where('prova_id', $prova->id)
                        ->where('aluno_id', $this->aluno->id)
                        ->first();

                    //dd($ap);

                    if ($ap->estado == 'realizada' || $ap->estado == 'realizando') {
                        return 'prova realizada';
                    } else {
                        return 'true';
                    }
                }
            }
        } else {
            return 'false';
        }
    }

    public function calcula_resultado($id)
    {

        date_default_timezone_set("Africa/Luanda");
        $data_hoje = date("Y-m-d");
        $hora_hoje = date("H:i:s");
        $prova = Prova::find($id);

        // verifica se o aluno já fez a prova
        $ap = Atribuicaoalunoprova::where('prova_id', $prova->id)
            ->where('aluno_id', $this->aluno->id)
            ->first();

        $af = Alunoformacao::where('aluno_id', $this->aluno->id)->first();

        if ($ap != null) {
            if ($ap->estado == 'atribuido') {
                return 'Nota Indisponível';
            } else if ($ap->estado == 'não realizada') {
                return 'Nota Indisponível';
            } else if ($ap->estado == 'realizando' && $data_hoje == $prova->data_prova && strtotime($hora_hoje) < strtotime($prova->hora_fim)) {
                return 'Nota Indisponível';
            } else if ($ap->estado == 'realizando' && $data_hoje == $prova->data_prova && strtotime($hora_hoje) >= strtotime($prova->hora_fim)) {
                return $this->pega_nota($prova->disciplina_id, $af->turma_id, $prova->id);
            } else if ($ap->estado == 'realizando' && $data_hoje > $prova->data_prova) {
                return $this->pega_nota($prova->disciplina_id, $af->turma_id, $prova->id);
            } else if ($ap->estado == 'realizada') {
                return $this->pega_nota($prova->disciplina_id, $af->turma_id, $prova->id);
            }
        } else {
            return 'Nota Indisponível';
        }

    }

    public function pega_nota($disciplina_id, $turma_id, $prova_id)
    {
        // $respostas = Respostaprova::where('prova_id', $prova_id)
        //     ->where('aluno_id', $this->aluno->id)
        //     ->where('disciplina_id', $disciplina_id)
        //     ->get();

        // $nota = 0;

        // foreach ($respostas as $resp) {
        //     $nota = $nota + $resp->cotacao;
        // }

        $avaliacao = Avaliacaoaluno::where('aluno_id', $this->aluno->id)
            ->where('disciplina_id', $disciplina_id)
            ->where('turma_id', $turma_id)
            ->first();

        if ($avaliacao != null) {

            if ($prova_id >= 25) {
                return $avaliacao->nota1 > 20 ? 20 : $avaliacao->nota1;
            } else {
                return $avaliacao->nota2 > 20 ? 20 : $avaliacao->nota2;
            }
            
        } else {
            return 'Nota Indisponível';
        }

    }
}