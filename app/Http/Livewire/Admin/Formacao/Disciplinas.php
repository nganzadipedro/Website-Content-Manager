<?php

namespace App\Http\Livewire\Admin\Formacao;

use App\Models\Fio\Disciplina;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Disciplinas extends Component
{

    public $lista = array();
    public $descricao;

    public function render()
    {
        $this->lista = Disciplina::all();
        return view('dashboard.admin.formacao.disciplinas')->extends('layouts.app')->section('conteudo');
    }

    public function cadastrar(){

        $disciplina = Disciplina::create([
            'descricao' => $this->descricao,
            'user_id' => Auth::id()
        ]);

        $this->mensagemRefresh('Cadastrado com sucesso', 'success');
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
