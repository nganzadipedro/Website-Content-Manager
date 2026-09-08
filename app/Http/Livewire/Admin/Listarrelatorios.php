<?php

namespace App\Http\Livewire\Admin;

use App\Models\Relatoriofinanceiro;
use Livewire\Component;

class Listarrelatorios extends Component
{

    public $lista = array();
    public function render()
    {
        $this->lista = Relatoriofinanceiro::orderBy('id', 'desc')->get();
        return view('dashboard.admin.listar-relatorios')->extends('layouts-new.app')->section('content');
    }
}
