<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Municipio;
use Livewire\Component;

class Registarassociado extends Component
{

    public $municipios = array();

    public function render()
    {
        $this->municipios = Municipio::all();
        return view('dashboard.areatecnica.registar-associado')->extends('layouts-new.app')->section('content');
    }
}
