<?php

namespace App\Http\Livewire\Admin\Relatorios;

use App\Models\Provincia;
use Livewire\Component;

class Index extends Component
{
    public $provincia_id;
    public $provincia_filtro = array();
    public $provincias = array();
    public function render()
    {
        $this->provincias = Provincia::all();
        return view('dashboard.admin.relatorios.index')->extends('layouts.app')->section('conteudo');
    }
}
