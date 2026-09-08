<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Adicionarrelatorio extends Component
{
    public function render()
    {
        return view('dashboard.admin.adicionar-relatorio')->extends('layouts-new.app')->section('content');
    }
}
