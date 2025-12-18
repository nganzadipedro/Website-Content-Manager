<?php

namespace App\Http\Livewire\Geral;

use Livewire\Component;

class Gerenciarwebsite extends Component
{
    public function render()
    {
         return view('dashboard.geral.gerenciar-website')->extends('layouts-new.app')->section('content');
    }
}
