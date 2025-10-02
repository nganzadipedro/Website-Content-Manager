<?php

namespace App\Http\Livewire\Admin;

use App\Models\Platform\Advogado;
use Livewire\Component;

class Listarindefinidos extends Component
{

    public $lista_advogados = array();

    public function render()
    {
        $this->lista_advogados = Advogado::where('categoria', 'Por especificar')->get();
        return view('dashboard.admin.listar-indefinidos')->extends('layouts.main')->section('content');
    }
}
