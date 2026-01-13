<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Pedidoassistencia;
use Livewire\Component;

class Ajarquivados extends Component
{

    public $lista = array();

    public function render()
    {
        $this->lista = Pedidoassistencia::where('estado', 'arquivado')
        ->orderBy('id', 'desc')->get();
        return view('dashboard.areatecnica.aj-arquivados')->extends('layouts-new.app')->section('content');
    }

}
