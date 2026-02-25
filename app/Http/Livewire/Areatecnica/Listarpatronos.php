<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Patrono;
use Livewire\Component;

class Listarpatronos extends Component
{

    public $patronos = array();
    public function render()
    {

        $this->patronos = Patrono::all();
        return view('dashboard.areatecnica.listar-patronos')->extends('layouts-new.app')->section('content');
    }
}
