<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Inscricaoadvogado;
use Livewire\Component;

class Listacn extends Component
{
    public function render()
    {

        $this->lista = Inscricaoadvogado::query()
            ->join('registo_entrada', 'registo_entrada.id', 'inscricao_advogado.registo_entrada_id')
            ->where('inscricao_advogado.tipo_processo_id', 2)
            ->where('inscricao_advogado.estado', 'remetido ao CN')
            ->orderBy('registo_entrada.proveniencia', 'asc')
            ->select('inscricao_advogado.*')
            ->get();

        return view('dashboard.areatecnica.lista-cn')->extends('layouts-new.app')->section('content');
    }
}
