<?php

namespace App\Http\Livewire\Admin;

use App\Models\Advogado;
use Livewire\Component;

class Listaradvogados extends Component
{

    public $lista_advogados = array();
    public function render()
    {

        $this->lista_advogados = Advogado::where('categoria', 'Advogado')->get();
        return view('dashboard.admin.listar-advogados')->extends('layouts.main')->section('content');
    }
}
