<?php

namespace App\Http\Livewire\Admin;

use App\Models\Platform\Advogado;
use Livewire\Component;

class Listarestagiarios extends Component
{

    public $lista_advogados = array();

    public function render()
    {
        $this->lista_advogados = Advogado::where('categoria', 'Estagiario')->get();
        return view('dashboard.admin.listar-advogados-estagiarios')->extends('layouts.main')->section('content');
    }
}
