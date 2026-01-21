<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Inscricaoadvogado;
use Livewire\Component;

class Listacn extends Component
{
    public function render()
    {
        $this->lista = Inscricaoadvogado::where('tipo_processo_id', 2)
            ->whereNotNull('data_remessa_cn')
            ->whereNotNull('data_emissao_cedula')
            ->whereNotNull('numero_cedula')
            ->where('cedula_disponivel', 'Sim')
            ->orderBy('id', 'desc')->get();
        return view('dashboard.areatecnica.lista-cn')->extends('layouts-new.app')->section('content');
    }
}
