<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Assistenciajudiciaria;
use App\Models\Pedidoassistencia;
use Livewire\Component;

class Ajarquivados extends Component
{
    public $lista = array();
    public function render()
    {
        $this->lista = Assistenciajudiciaria::all();
        return view('dashboard.areatecnica.aj-arquivados')->extends('layouts-new.app')->section('content');
    }

}
