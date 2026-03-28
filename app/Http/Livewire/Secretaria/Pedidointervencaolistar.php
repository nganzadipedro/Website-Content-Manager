<?php

namespace App\Http\Livewire\Secretaria;

use App\Models\Pedidointervencao;
use Livewire\Component;

class Pedidointervencaolistar extends Component
{

    public $pedidos = array();
    public $categoria_p;

    public function mount($categoria){
        $this->categoria_p = $categoria;
    }

    public function render() {
        $this->pedidos = Pedidointervencao::where('estado', $this->categoria_p)->get();
        return view('dashboard.secretaria.pedido-intervencao-listar')->extends('layouts-new.app')->section('content');
    }
    
}
