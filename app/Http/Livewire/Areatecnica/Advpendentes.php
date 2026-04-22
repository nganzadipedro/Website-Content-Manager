<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Registoentrada;
use App\Models\User;
use Livewire\Component;

class Advpendentes extends Component
{
    public function render()
    {
        $this->lista_conselheiros = User::where('permissao_id', 5)->get();
        $this->lista = Registoentrada::where('estado', 'pendente')
            ->where('tipo_processo_id', 2)
            ->where('encaminhado', 'Área Técnica')->orderBy('id', 'asc')->get();
            
        return view('dashboard.areatecnica.adv-pendentes')->extends('layouts-new.app')->section('content');
    }
}
