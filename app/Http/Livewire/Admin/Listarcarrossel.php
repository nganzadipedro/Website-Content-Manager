<?php

namespace App\Http\Livewire\Admin;

use App\Models\Carrossel;
use Livewire\Component;

class Listarcarrossel extends Component
{

    public $lista_carrossel = array();

    public function render()
    {
        $this->lista_carrossel = Carrossel::orderBy('id', 'desc')->get();
        return view('dashboard.admin.listar-carrossel')->extends('layouts-new.app')->section('content');
        ;
    }
}
