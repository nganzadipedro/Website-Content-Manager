<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Inscricaoadvogado;
use App\Models\User;
use Livewire\Component;

class Advregistados extends Component
{

    public $lista_conselheiros;

    public function render()
    {

        $this->lista_conselheiros = User::where('permissao_id', 5)->get();
        $this->lista = Inscricaoadvogado::where('tipo_processo_id', 2)->orderBy('id', 'desc')->get();
        return view('dashboard.areatecnica.adv-registados')->extends('layouts-new.app')->section('content');
    }
}
