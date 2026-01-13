<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Inscricaoadvogado;
use Livewire\Component;

class Advregistados extends Component
{
    public function render()
    {
        $this->lista = Inscricaoadvogado::where('tipo_processo_id', 2)->orderBy('id', 'desc')->get();
        return view('dashboard.areatecnica.adv-registados')->extends('layouts-new.app')->section('content');
    }
}
