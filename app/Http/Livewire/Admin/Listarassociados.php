<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class Listarassociados extends Component
{

    public $lista_usuarios = array();


    public function render()
    {
        $this->lista_usuarios = User::where('permissao_id', 3)->get();
        return view('dashboard.admin.listar-associados')->extends('layouts.main')->section('content');
    }
}
