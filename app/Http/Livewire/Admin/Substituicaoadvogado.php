<?php

namespace App\Http\Livewire\Admin;

use App\Models\Advogadoatribuido;
use App\Models\Platform\Advogado;
use Livewire\Component;

class Substituicaoadvogado extends Component
{
    public $lista_advogados = array();
    public $lista_advogados_geral = array();
    public $advogados_atribuidos = array();


    public function render()
    {
        $this->lista_advogados_geral = Advogado::join('pessoa', 'app_advogado.pessoa_id', 'pessoa.id')
            ->where('app_advogado.categoria', 'Advogado')
            ->orWhere('app_advogado.categoria', 'Estagiario')
            ->orderBy('pessoa.nome', 'asc')
            ->select('app_advogado.*')->get();

        return view('dashboard.admin.substituicao-advogado')->extends('layouts-new.app')->section('content');
    }
}
