<?php

namespace App\Http\Livewire\Secretaria;

use App\Models\Municipio;
use App\Models\Platform\Advogado;
use Livewire\Component;

class Pedidointervencaocadastrar extends Component
{

    public $lista_advogados = array();
    public $municipios = array();

    public function render()
    {
        $this->lista_advogados = Advogado::all();
        $this->municipios = Municipio::all();
        return view('dashboard.secretaria.pedido-intervencao-cadastrar')->extends('layouts-new.app')->section('content');
    }
}
