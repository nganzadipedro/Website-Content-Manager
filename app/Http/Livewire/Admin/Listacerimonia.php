<?php

namespace App\Http\Livewire\Admin;

use App\Models\Platform\Advogado;
use Auth;
use Livewire\Component;

class Listacerimonia extends Component
{

    public $categoria;

    public $lista_advogados = array();

    public function render()
    {

        $this->lista_advogados = Advogado::join('pessoa', 'pessoa.id', 'app_advogado.pessoa_id')
            ->where('app_advogado.estado', 'Aguarda Cerimónia')
            ->orderBy('pessoa.nome')
            ->select('app_advogado.*', 'pessoa.id as id_pessoa')
            ->get();

        if (Auth::user()->permissao_id == 3) {
            return view('dashboard.areatecnica.listar-aguarda-cerimonia')->extends('layouts-new.app')->section('content');
        }

    }

    public function updatedCategoria($valor)
    {

        $this->lista_advogados = Advogado::join('pessoa', 'pessoa.id', 'app_advogado.pessoa_id')
            ->where('app_advogado.estado', 'Aguarda Cerimónia')
            ->where('app_advogado.categoria', $valor)
            ->orderBy('pessoa.nome')
            ->select('app_advogado.*', 'pessoa.id as id_pessoa')
            ->get();

        // $this->resetPage();  se estiver usando paginação
    }
}
