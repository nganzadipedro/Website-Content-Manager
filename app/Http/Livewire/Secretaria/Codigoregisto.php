<?php

namespace App\Http\Livewire\Secretaria;

use App\Models\Registoentrada;
use Livewire\Component;

class Codigoregisto extends Component
{

    public $hash_registo;
    public $registo;

    public function mount($hash)
    {

        $this->hash_registo = $hash;
        $this->registo = Registoentrada::where('hash', $this->hash_registo)->first();

    }


    public function render()
    {
        return view('dashboard.secretaria.codigo-registo')->extends('layouts-new.app')->section('content');
    }
}
