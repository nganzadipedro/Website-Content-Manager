<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Inscricaoadvogado;
use App\Models\User;
use Livewire\Component;

class Mapadistribuicao extends Component
{
    public function render()
    {
        $this->lista_conselheiros = User::where('permissao_id', 5)->get();
        $this->lista = Inscricaoadvogado::where('tipo_processo_id', 2)
        ->where('despacho', 'Indeferido')
        ->orWhereNull('despacho')
        ->orderBy('id', 'desc')->get();
        return view('dashboard.areatecnica.mapa-distribuicao')->extends('layouts-new.app')->section('content');
    }
}
