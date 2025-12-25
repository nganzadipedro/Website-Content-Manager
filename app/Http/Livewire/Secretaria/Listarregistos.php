<?php

namespace App\Http\Livewire\Secretaria;

use App\Models\Registoentrada;
use Livewire\Component;

class Listarregistos extends Component
{

    public $lista = array();
    public function render()
    {
        $this->lista = Registoentrada::orderBy('id', 'desc')->get();
        return view('dashboard.secretaria.listar-registos')->extends('layouts-new.app')->section('content');
    }
}
