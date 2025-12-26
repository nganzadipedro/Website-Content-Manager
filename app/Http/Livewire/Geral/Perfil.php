<?php

namespace App\Http\Livewire\Geral;

use App\Http\Controllers\ActividadesistemaController;
use Auth;
use Livewire\Component;

class Perfil extends Component
{

    public $user;
    public $pessoa;
    public $email;

    public function mount()
    {
        $this->user = Auth::user();
        $this->pessoa = $this->user->getpessoa;
        $this->email = $this->pessoa->email;
    }

    public function render()
    {
        return view('auth.profile')->extends('layouts-new.app')->section('content');
    }

    public function actualizarEmail()
    {
        $this->pessoa->email = $this->email;
        $this->pessoa->save();

        ActividadesistemaController::inserir(Auth::id(), "Actualizou o seu email no sistema", 'user', $this->user->id);
        $this->mensagemRefresh('Email actualizado actualizado com sucesso', 'success');
    }

    private function mensagem($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal2', [
            'title' => '',
            'text' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            'toast' => false,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'center'
        ]);
    }

    private function mensagemRefresh($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal', [
            'title' => '',
            'text' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            'toast' => false,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'center'
        ]);
    }
}
