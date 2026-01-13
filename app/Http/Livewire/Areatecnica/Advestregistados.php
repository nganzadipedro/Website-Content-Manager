<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Inscricaoadvogado;
use Livewire\Component;

class Advestregistados extends Component
{
    public function render()
    {
        $this->lista = Inscricaoadvogado::where('tipo_processo_id', 3)->orderBy('id', 'desc')->get();
        return view('dashboard.areatecnica.advest-registados')->extends('layouts-new.app')->section('content');
    }
}
