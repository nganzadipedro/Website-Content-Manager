<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Registoentrada;
use Livewire\Component;

class Ajpendentes extends Component
{

    public $lista = array();

    public function render()
    {
        $this->lista = Registoentrada::where('estado', 'pendente')
        ->where('tipo_processo_id', 1)
        ->where('encaminhado', 'Presidente')->orderBy('id', 'asc')->get();
        return view('dashboard.areatecnica.aj-pendentes')->extends('layouts-new.app')->section('content');
    }
}
