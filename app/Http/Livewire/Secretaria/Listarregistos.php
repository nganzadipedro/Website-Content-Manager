<?php

namespace App\Http\Livewire\Secretaria;

use App\Models\Registoentrada;
use Auth;
use Livewire\Component;

class Listarregistos extends Component
{

    public $lista = array();
    public function render()
    {
        $this->lista = Registoentrada::orderBy('id', 'desc')->get();
        if (Auth::user()->permissao_id == 2) {
            return view('dashboard.secretaria.listar-registos')->extends('layouts-new.app')->section('content');
        } elseif (Auth::user()->permissao_id == 3) {
            return view('dashboard.areatecnica.listar-registos')->extends('layouts-new.app')->section('content');
        }
    }
}
