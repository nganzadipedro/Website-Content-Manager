<?php

namespace App\Http\Livewire\Geral\Provas;

use App\Models\Fio\Disciplina;
use App\Models\Fio\Perguntaprova;
use App\Models\Fio\Professor;
use App\Models\Fio\Professorformacao;
use App\Models\Fio\Prova;
use App\Models\Fio\Turma;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cadastrar extends Component
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
    public $editar = false;

    public function render()
    {

        $this->professor = Professor::where('pessoa_id', Auth::user()->pessoa_id)->first();
        $this->lista = Prova::where('professor_id', $this->professor->id)->orderBy('id', 'desc')->get();
        $this->disciplinas = Disciplina::all();
        return view('dashboard.provas.cadastrar')->extends('layouts.app')->section('conteudo');

    }

    public function getturmas()
    {
        $this->turmas = Professorformacao::where('disciplina_id', $this->disciplina_id)->where('professor_id', $this->professor->id)
            ->get();
    }

    public function cadastrar()
    {

        $turma = Turma::find($this->turma_id);
        if ($this->editar == false) {

            $verifica = Prova::where('turma_id', $turma->id)
                ->where('disciplina_id', $this->disciplina_id)
                ->where('professor_id', $this->professor->id)
                ->where('nome', strtoupper($this->nome))
                ->first();

            if ($verifica) {
                $this->mensagem('Esta prova já foi cadastrada', 'warning');
            } else {
                $prova = Prova::create([
                    'disciplina_id' => $this->disciplina_id,
                    'professor_id' => $this->professor->id,
                    'turma_id' => $this->turma_id,
                    'nome' => strtoupper($this->nome),
                    'data_prova' => $this->data_prova,
                    'hora_inicio' => $this->hora_inicio,
                    'hora_fim' => $this->hora_fim,
                    'ativo' => 'Sim',
                    'ano_id' => $turma->getFormacao->ano_id,
                    'user_id' => Auth::id()
                ]);

                $prova->hash = md5($prova->created_at . $prova->id);
                $prova->save();
                $this->mensagemRefresh('Prova cadastrada com sucesso', 'success');
                $this->limpar();
            }


        } else {
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
                $this->limpar();

            }
        }


    }

    public function eliminar($id){

        $prova = Prova::find($id);
        if(count($prova->getalunos) > 0){
            $this->mensagem('Não é possível eliminar esta prova. Já foi atribuída para os formandos', 'warning');
        }
        else{
            // elimina as perguntas primeiro
            $perguntas = Perguntaprova::where('prova_id', $id)->get();
            foreach ($perguntas as $perg) {
                $perg->delete();
            }

            // elimina a prova
            $prova->delete();

            $this->mensagemRefresh('Prova eliminada com sucesso!', 'success');
        }

    }

    public function select($id)
    {

        $prova = Prova::find($id);
        $this->prova_id = $prova->id;
        $this->disciplina_id = $prova->disciplina_id;
        $this->turma_id = $prova->turma_id;
        $this->nome = $prova->nome;
        $this->data_prova = $prova->data_prova;
        $this->hora_inicio = $prova->hora_inicio;
        $this->hora_fim = $prova->hora_fim;
        $this->editar = true;

    }

    public function limpar()
    {
        $this->disciplina_id = null;
        $this->turma_id = null;
        $this->nome = null;
        $this->data_prova = null;
        $this->hora_inicio = null;
        $this->hora_fim = null;
        $this->editar = false;
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
}
