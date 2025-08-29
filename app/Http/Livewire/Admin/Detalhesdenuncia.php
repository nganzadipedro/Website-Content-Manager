<?php

namespace App\Http\Livewire\Admin;

use App\Models\Denuncia;
use Livewire\Component;

class Detalhesdenuncia extends Component
{

    public $msg_hash;
    public $mensagem;
    public $tipo = 'denuncia';

    public function mount($hash)
    {
        $this->msg_hash = $hash;
    }
    public function render()
    {
        $this->mensagem = Denuncia::where('hash', $this->msg_hash)->first();
        return view('dashboard.admin.detalhes-mensagem')->extends('layouts.main')->section('content');
    }

      public function marcar_atendida()
    {

        $this->mensagem->estado = 'atendida';
        $this->mensagem->save();
        $this->mensagem('Operação realizada com sucesso', 'success');

    }

    private function mensagem($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal2', [
            'title' => '',
            'text' => $msg,
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
            'title' => '',
            'text' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            'toast' => true,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'top-right'
        ]);
    }

}
