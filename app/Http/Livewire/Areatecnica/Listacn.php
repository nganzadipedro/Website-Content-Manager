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
            ->where('estado', 'remetido ao CN')
            ->orderBy('id', 'desc')->get();
        return view('dashboard.areatecnica.lista-cn')->extends('layouts-new.app')->section('content');
    }
}
