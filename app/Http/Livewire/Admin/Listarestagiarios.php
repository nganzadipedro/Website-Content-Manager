<?php

namespace App\Http\Livewire\Admin;

use App\Models\Platform\Advogado;
use Auth;
use Livewire\Component;

class Listarestagiarios extends Component
{

    public $lista_advogados = array();

    public function render()
    {
        $this->lista_advogados = Advogado::where('categoria', 'Estagiario')->get();

        if (Auth::user()->permissao_id == 1 || Auth::user()->permissao_id == 6) {
            return view('dashboard.admin.listar-advogados-estagiarios')->extends('layouts-new.app')->section('content');
        } else if (Auth::user()->permissao_id == 3) {
            return view('dashboard.areatecnica.listar-advogados-estagiarios')->extends('layouts-new.app')->section('content');
        }


    }
}
