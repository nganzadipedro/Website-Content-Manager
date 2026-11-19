<?php

namespace App\Http\Livewire\Geral\Provas;

use App\Models\Fio\Alunoformacao;
use App\Models\Fio\Atribuicaoalunoprova;
use App\Models\Fio\Prova;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Atribuiralunos extends Component
{

    public $prova;
    public $hash_prova;
    public $alunos_atribuidos = array();
    public $alunos_nao_atribuidos = array();

    public function mount($hash)
    {
        $this->hash_prova = $hash;
        $this->prova = Prova::where('hash', $this->hash_prova)->first();

    }
    public function render()
    {
        $this->alunos_atribuidos = Atribuicaoalunoprova::where('prova_id', $this->prova->id)
            ->get();

        $this->alunos_nao_atribuidos = Alunoformacao::join('aluno', 'alunos_formacao.aluno_id', 'aluno.id')
            ->join('pessoas', 'pessoas.id', 'aluno.pessoa_id')
            ->where('alunos_formacao.turma_id', $this->prova->turma_id)
            ->select('alunos_formacao.*')
            ->orderBy('pessoas.nome', 'asc')
            ->get();

        // dd($this->alunos_nao_atribuidos);

        return view('dashboard.provas.atribuir-alunos')->extends('layouts.app')->section('conteudo');
    }

    public function atribuido($aluno_id)
    {

        $verifica = Atribuicaoalunoprova::where('aluno_id', $aluno_id)
            ->where('prova_id', $this->prova->id)
            ->first();

        if ($verifica) {
            return 'true';
        } else {
            return 'false';
        }

    }

    public function atribuir_todos()
    {

        foreach ($this->alunos_nao_atribuidos as $item) {
            if ($this->atribuido($item->aluno_id) == 'false') {
                $add = Atribuicaoalunoprova::create([
                    'prova_id' => $this->prova->id,
                    'aluno_id' => $item->aluno_id,
                    'disciplina_id' => $this->prova->disciplina_id,
                    'user_id' => Auth::id()
                ]);
            }
        }

        $this->mensagemRefresh('Alunos adicionados com sucesso', 'success');
    }

    public function adicionar($aluno_id)
    {

        $add = Atribuicaoalunoprova::create([
            'prova_id' => $this->prova->id,
            'aluno_id' => $aluno_id,
            'disciplina_id' => $this->prova->disciplina_id,
            'user_id' => Auth::id()
        ]);

        $this->mensagem('Aluno adicionado com sucesso', 'success');

    }

    public function eliminar($id)
    {

        $registo = Atribuicaoalunoprova::find($id);
        $registo->delete();
        $this->mensagem('Aluno removido com sucesso', 'success');

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
