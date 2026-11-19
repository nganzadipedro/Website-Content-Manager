<?php

namespace App\Http\Livewire\Formador;

use App\Models\Fio\Alunoformacao;
use App\Models\Fio\Avaliacaoaluno;
use App\Models\Fio\Professor;
use App\Models\Fio\Professorformacao;
use App\Models\Fio\Turma;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Editarnotas extends Component
{

    public $turma_id;
    public $formacao_id;
    public $disciplina_id;
    public $turma;
    public $com_notas;
    public $sem_notas;
    public $alunos_turma;
    public $professor;
    public $prof_formacao;
    public $alunos;
    public $nota1;
    public $nota1edit;
    public $nota2;
    public $nota2edit;
    public $alunoidedit;
    public $observacao;

    public function mount($id_turma)
    {
        $this->turma_id = $id_turma;
        $this->turma = Turma::find($this->turma_id);
    }

    public function render()
    {
        $this->professor = Professor::where('pessoa_id', Auth::user()->pessoa_id)->first();
        $this->prof_formacao = Professorformacao::where('professor_id', $this->professor->id)->where('turma_id', $this->turma_id)->first();
        $this->disciplina_id = $this->prof_formacao->disciplina_id;
        $this->formacao_id = $this->prof_formacao->formacao_id;

        $tem_alunos = Avaliacaoaluno::where('turma_id', $this->turma_id)
            ->where('disciplina_id', $this->disciplina_id)
            ->get();

        if (count($tem_alunos) == 0) {
            $this->colocaalunos_avaliacao();
        }

        $this->alunos_turma = Alunoformacao::join('aluno', 'alunos_formacao.aluno_id', 'aluno.id')
            ->join('pessoas', 'pessoas.id', 'aluno.pessoa_id')
            ->where('alunos_formacao.turma_id', $this->turma_id)
            ->select('alunos_formacao.*')
            ->orderBy('pessoas.nome', 'asc')
            ->get();


        $this->com_notas = Avaliacaoaluno::where('turma_id', $this->turma_id)
            ->where('disciplina_id', $this->disciplina_id)
            ->whereNotNull('notafinal')
            ->count();


        $this->sem_notas = Avaliacaoaluno::where('turma_id', $this->turma_id)
            ->where('disciplina_id', $this->disciplina_id)
            ->whereNull('nota1')
            ->whereNull('notafinal')
            ->whereNull('nota2')->count();

        return view('dashboard.formador.editar-notas')->extends('layouts.app')->section('conteudo');
    }


    public function jatemnota($aluno_id)
    {

        $existe = Avaliacaoaluno::whereNotNull('notafinal')
            ->where('disciplina_id', $this->disciplina_id)
            ->where('turma_id', $this->turma_id)
            ->where('aluno_id', $aluno_id)->first();

        if ($existe) {
            return true;
        } else {
            return false;
        }

    }

    public function getavaliacao_aluno($aluno_id)
    {

        $existe = Avaliacaoaluno::where('disciplina_id', $this->disciplina_id)
            ->where('turma_id', $this->turma_id)
            ->where('aluno_id', $aluno_id)->first();

        if ($existe) {
            return $existe;
        } else {
            $av = Avaliacaoaluno::create([
                'turma_id' => $this->turma_id,
                'disciplina_id' => $this->disciplina_id,
                'aluno_id' => $aluno_id,
                'formacao_id' => $this->formacao_id
            ]);

            return $av;
        }

    }
}
