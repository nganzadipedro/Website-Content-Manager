<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class Listarusuario extends Component
{

    public $lista_usuarios = array();
    public function render()
    {

        $this->lista_usuarios = User::where('permissao_id', '!=', 3)->get();
        return view('dashboard.admin.listar-usuarios')->extends('layouts-new.app')->section('content');

    }
}
