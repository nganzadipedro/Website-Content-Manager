<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Municipio;
use App\Models\Patrono;
use Auth;
use Livewire\Component;

class Registarassociado extends Component
{

    public $municipios = array();
    public $patronos = array();
    public $lista_patronos = array();

    public function render()
    {
        $this->patronos = Patrono::all();
        foreach ($this->patronos as $pat) {
            $registo = [];
            $registo[0] = $pat->id;
            $registo[1] = $pat->advogado_id;
            $registo[2] = $pat->getadvogado->getpessoa->nome;

            array_push($this->lista_patronos, $registo);
        }

        $this->municipios = Municipio::all();
        if (Auth::user()->permissao_id == 3) {
            return view('dashboard.areatecnica.registar-associado')->extends('layouts-new.app')->section('content');
        }

        return view('dashboard.secretaria.registar-associado')->extends('layouts-new.app')->section('content');

    }
}
