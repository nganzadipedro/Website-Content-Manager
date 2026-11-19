<?php

namespace App\Http\Livewire\Geral\Provas;

use App\Models\Fio\Disciplina;
use App\Models\Fio\Professor;
use App\Models\Fio\Professorformacao;
use App\Models\Fio\Prova;
use App\Models\Fio\Turma;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Editarprova extends Component
{

    public $lista = array();
    public $disciplinas = array();
    public $professor;
    public $turmas = array();
    public $disciplina_id;
    public $professor_id;
    public $turma_id;
    public $nome;
    public $data_prova;
    public $hora_inicio;
    public $hora_fim;

    public $prova_id;
    public $editar = true;

    public function mount($hash)
    {

        $this->prova_hash = $hash;
        $this->prova = Prova::where('hash', $this->prova_hash)->first();
        $this->prova_id = $this->prova->id;
        $this->hora_fim = $this->prova->hora_fim;
        $this->hora_inicio = $this->prova->hora_inicio;
        $this->data_prova = $this->prova->data_prova;
        $this->nome = $this->prova->nome;
        $this->disciplina_id = $this->prova->disciplina_id;
        $this->turma_id = $this->prova->turma_id;

    }
    public function render()
    {
        $this->disciplinas = Disciplina::all();
        $this->professor = Professor::where('pessoa_id', Auth::user()->pessoa_id)->first();
        return view('dashboard.provas.editar')->extends('layouts.app')->section('conteudo');
    }

    public function cadastrar()
    {

        $turma = Turma::find($this->turma_id);
        if ($this->editar == true) {

            $verifica = Prova::where('turma_id', $turma->id)
                ->where('disciplina_id', $this->disciplina_id)
                ->where('professor_id', $this->professor->id)
                ->where('nome', strtoupper($this->nome))
                ->where('id', '!=', $this->prova_id)->first();

            if ($verifica) {
                $this->mensagem('Esta prova já foi cadastrada', 'warning');
            } else {

                $prova = Prova::find($this->prova_id);
                $prova->disciplina_id = $this->disciplina_id;
                $prova->professor_id = $this->professor->id;
                $prova->turma_id = $this->turma_id;
                $prova->nome = strtoupper($this->nome);
                $prova->data_prova = $this->data_prova;
                $prova->hora_inicio = $this->hora_inicio;
                $prova->hora_fim = $this->hora_fim;
                $prova->ativo = 'Sim';
                $prova->ano_id = $turma->getFormacao->ano_id;
                $prova->user_id = Auth::id();
                $prova->save();

                $this->mensagemRefresh('Prova actualizada com sucesso', 'success');
                return redirect()->route('provas.listar');

            }
        }
    }

    public function getturmas()
    {
        $this->turmas = Professorformacao::where('disciplina_id', $this->disciplina_id)->where('professor_id', $this->professor->id)
            ->get();
    }

    private function mensagem($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal2', [
            'title' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            'toast' => true,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'top-right'
        ]);
    }

    private function mensagemRefresh($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal', [
            'title' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            'toast' => true,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'top-right'
        ]);
    }
}
