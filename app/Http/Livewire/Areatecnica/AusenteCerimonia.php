<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Platform\Advogado;
use Auth;
use Livewire\Component;

class AusenteCerimonia extends Component
{

    public $categoria_p;
    public $categoria_nome;

    public $lista_advogados = array();

    public function mount($categoria)
    {
        $this->categoria_p = $categoria;
        if ($this->categoria_p == 'Advogado') {
            $this->categoria_nome = 'Advogados';
        } else {
            $this->categoria_nome = 'Advogados Estagiários';
        }
    }
    public function render()
    {

        $this->lista_advogados = Advogado::join('pessoa', 'pessoa.id', 'app_advogado.pessoa_id')
            ->where('app_advogado.estado', 'Aguarda Cerimónia')
            ->where('app_advogado.categoria', $this->categoria_p)
            ->where('app_advogado.presenca_cerimonia', 'Ausente')
            ->orderBy('pessoa.nome')
            ->select('app_advogado.*', 'pessoa.id as id_pessoa')
            ->get();

        if (Auth::user()->permissao_id == 3) {
            return view('dashboard.areatecnica.listar-ausentes-cerimonia')->extends('layouts-new.app')->section('content');
        }
        
    }
}
