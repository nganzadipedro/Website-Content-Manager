<?php

namespace App\Http\Livewire\Secretaria;

use App\Models\Pedidointervencao;
use Livewire\Component;

class Pedidointervencaolistar extends Component
{

    public $pedidos = array();

    public function render() {
        $this->pedidos = Pedidointervencao::all();
        return view('dashboard.secretaria.pedido-intervencao-listar')->extends('layouts-new.app')->section('content');
    }
}
