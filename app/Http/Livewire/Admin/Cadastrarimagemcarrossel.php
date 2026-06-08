<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Cadastrarimagemcarrossel extends Component
{
    public function render()
    {
        return view('dashboard.admin.cadastrar-imagem-carrossel')->extends('layouts-new.app')->section('content');
    }
}
