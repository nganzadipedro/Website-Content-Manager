<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class Listarusuario extends Component
{

    public $lista_usuarios = array();
    public function render()
    {
        $this->lista_usuarios = User::all();
        return view('dashboard.admin.listar-usuario')->extends('layouts.main')->section('content');

    }
}
