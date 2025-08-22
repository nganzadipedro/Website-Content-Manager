<?php

namespace App\Http\Livewire\Admin;

use App\Models\Mensagem;
use Livewire\Component;

class Listarmensagens extends Component
{

    public $lista_mensagens;
    public $tipo_mensagem;

    public function mount($tipo)
    {
        $this->tipo_mensagem = $tipo;
    }
    public function render()
    {
        if ($this->tipo_mensagem == 'solved') {
            $this->lista_mensagens = Mensagem::where('estado', 'atendida')->orderBy('updated_at', 'desc')->get();
            return view('dashboard.admin.listar-mensagens')->extends('layouts.main')->section('content');
        } else {
            $this->lista_mensagens = Mensagem::where('estado', 'pendente')->orderBy('id', 'asc')->get();
            return view('dashboard.admin.listar-mensagens-pendentes')->extends('layouts.main')->section('content');
        }
    }
}
