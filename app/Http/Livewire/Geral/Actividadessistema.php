<?php

namespace App\Http\Livewire\Geral;

use App\Models\Historicosistema;
use Auth;
use Livewire\Component;

class Actividadessistema extends Component
{
    public function render()
    {
        $this->lista = Historicosistema::where('user_id', Auth::user()->id)
        ->where('destino', 'user')
        ->orderBy('id', 'desc')
        ->get();
        return view('auth.actividades')->extends('layouts-new.app')->section('content');
    }
}
