<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Registoentrada;
use Livewire\Component;

class Advestpendentes extends Component
{
    public function render()
    {
          $this->lista = Registoentrada::where('estado', 'pendente')
        ->where('tipo_processo_id', 3)
        ->where('encaminhado', 'Área Técnica')->orderBy('id', 'asc')->get();
        return view('dashboard.areatecnica.advest-pendentes')->extends('layouts-new.app')->section('content');
    }
}
