<?php

namespace App\Http\Livewire\Admin;

use App\Models\Galeria;
use Livewire\Component;

class Listargaleria extends Component
{
    public $lista_galeria = array();
    
    public function render()
    {
        $this->lista_galeria = Galeria::orderBy('id', 'desc')->get();
        return view('dashboard.admin.listar-galeria')->extends('layouts.main')->section('content');
    }
}
