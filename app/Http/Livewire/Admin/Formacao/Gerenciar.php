<?php

namespace App\Http\Livewire\Admin\Formacao;

use App\Models\Fio\Candidaturaformacao;
use App\Models\Fio\Disciplina;
use App\Models\Fio\Formacao;
use App\Models\Fio\Professor;
use App\Models\Fio\Professorformacao;
use App\Models\Fio\Turma;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Gerenciar extends Component
{

    public $formacao;
    public $professores;
    public $professores_adicionados;
    public $disciplinas;
    public $professor_id;
    public $disciplina_id;
    public $turma_id;
    public $desc_turma;
    public $capacidade;
    public $turmas = array();
    public $candidaturas = array();
    public $vet_inscricoes = array();
    public $edit_turma = false;

    public function mount($hash){
        $res = Formacao::where('hash', $hash)->first();
        if($res){
            $this->formacao = $res;
        }
    }

    public function render()
    {
        $this->turmas = Turma::where('formacao_id', $this->formacao->id)->get();
        $this->professores = Professor::all();
        $this->professores_adicionados = Professorformacao::where('formacao_id', $this->formacao->id)
        ->get();

        $this->disciplinas = Disciplina::all();

        $this->candidaturas = Candidaturaformacao::where('formacao_id', $this->formacao->id)->get();

        $this->vet_inscricoes[0] = Candidaturaformacao::where('formacao_id', $this->formacao->id)
        ->where('estado', 'pendente')->count();

        $this->vet_inscricoes[1] = Candidaturaformacao::where('formacao_id', $this->formacao->id)
        ->where('estado', 'aprovado')
        ->where('pago', 'não pago')->count();

        $this->vet_inscricoes[2] = Candidaturaformacao::where('formacao_id', $this->formacao->id)
        ->where('estado', 'aprovado')
        ->where('pago', 'pago')->count();

        return view('dashboard.admin.formacao.gerenciar')->extends('layouts.app')->section('conteudo');
    }

    public function add_professor(){

        $existe = null;

        if($this->formacao->tipoformacao_id == 1){

            if($this->professor_id == null){
                $this->mensagem('Escolha o professor', 'warning');
            }
            else if($this->disciplina_id == null){
                $this->mensagem('Escolha a disciplina', 'warning');
            }
            else if($this->turma_id == null){
                $this->mensagem('Escolha a turma', 'warning');
            }
            else{
                $existe = Professorformacao::where('formacao_id', $this->formacao->id)
                ->where('professor_id', $this->professor_id)
                ->where('turma_id', $this->turma_id)
                ->where('disciplina_id', $this->disciplina_id)->first();
            }
        }
        else{
            if($this->professor_id == null){
                $this->mensagem('Escolha o professor', 'warning');
            }
            else if($this->turma_id == null){
                $this->mensagem('Escolha a turma', 'warning');
            }
            else{
                $existe = Professorformacao::where('formacao_id', $this->formacao->id)
                ->where('professor_id', $this->professor_id)
                ->where('turma_id', $this->turma_id)
                ->first();
            }
        }

        if($existe){
            $this->mensagem('Este professor já foi adicionado nesta formação', 'warning');
        }
        else{

            $r = Professorformacao::create([
                'professor_id' => $this->professor_id,
                'formacao_id' => $this->formacao->id,
                'disciplina_id' => $this->disciplina_id,
                'turma_id' => $this->turma_id,
                'user_id' => Auth::id()
            ]);

            $this->mensagemRefresh('Professor adicionado com sucesso', 'success');

        }
    }

    public function add_turma(){

        if($this->desc_turma == null){
            $this->mensagem('Digite a descrição da turma', 'warning');
        }
        else if($this->capacidade == null){
            $this->mensagem('Digite a capacidade da turma', 'warning');
        }
        else{

            if($this->edit_turma == false){
                $t = Turma::create([
                    'descricao' => $this->desc_turma,
                    'formacao_id' => $this->formacao->id,
                    'user_id' => Auth::id(),
                    'capacidade' => $this->capacidade
                ]);

                $this->mensagemRefresh('Turma cadastrada com sucesso', 'success');
            }
            else{

                $turma = Turma::find($this->turma_id);
                $turma->desc_turma = $this->desc_turma;
                $turma->capacidade = $this->capacidade;
                $turma->save();

                $this->mensagemRefresh('Turma editada com sucesso', 'success');

            }

        }
    }

    public function selecionar($id){
        $turma = Turma::find($id);
        $this->desc_turma = $turma->descricao;
        $this->capacidade = $turma->capacidade;
        $this->edit_turma = true;
    }

    public function eliminar($id){

        $turma = Turma::find($id);
        if(count($turma->getAlunos) > 0){
            $this->mensagem('Esta turma não pode ser eliminada', 'warning');
        }
        else{
            $turma->delete();
            $this->mensagemRefresh('Turma eliminada com sucesso', 'success');
        }

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
