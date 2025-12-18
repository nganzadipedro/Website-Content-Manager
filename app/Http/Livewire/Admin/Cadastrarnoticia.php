<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Cadastrarnoticia extends Component
{
    public function render()
    {
         return view('dashboard.admin.cadastrar-noticia')->extends('layouts-new.app')->section('content');
    }
}
