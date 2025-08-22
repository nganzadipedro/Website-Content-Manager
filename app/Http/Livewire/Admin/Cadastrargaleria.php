<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Cadastrargaleria extends Component
{
    public function render()
    {
        return view('dashboard.admin.cadastrar-galeria')->extends('layouts.main')->section('content');
    }
}
