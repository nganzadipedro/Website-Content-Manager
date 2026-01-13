<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Registoentrada;
use Livewire\Component;

class Ajdeferidos extends Component
{
    public function render()
    {
        $this->lista = Registoentrada::where('estado', 'deferido')
        ->where('tipo_processo_id', 1)
            ->where('encaminhado', 'Área Técnica')->orderBy('id', 'asc')->get();
        return view('dashboard.areatecnica.aj-deferidos')->extends('layouts-new.app')->section('content');
    }
}
