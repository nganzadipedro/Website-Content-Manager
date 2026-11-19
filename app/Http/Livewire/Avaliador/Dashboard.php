<?php

namespace App\Http\Livewire\Avaliador;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {

        return view('dashboard.avaliador.index')->extends('layouts.app')->section('conteudo');

    }
}
