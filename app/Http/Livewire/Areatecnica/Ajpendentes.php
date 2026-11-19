<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Pedidoassistencia;
use App\Models\Registoentrada;
use Livewire\Component;

class Ajpendentes extends Component
{

    public $lista = array();

    public function render()
    {
        $this->lista = Pedidoassistencia::
            where('estado', 'deferido')
            ->orderBy('id', 'desc')->get();
        return view('dashboard.areatecnica.aj-pendentes')->extends('layouts-new.app')->section('content');
    }
}
