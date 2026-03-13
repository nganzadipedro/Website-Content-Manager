<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Inscricaoadvogado;
use Livewire\Component;

class Advestremetidoscn extends Component
{
    public function render()
    {
        $this->lista = Inscricaoadvogado::query()
            ->join('registo_entrada', 'registo_entrada.id', 'inscricao_advogado.registo_entrada_id')
            ->where('inscricao_advogado.tipo_processo_id', 3)
            ->where('inscricao_advogado.cedula_disponivel', 'Não')
            ->whereNotNull('inscricao_advogado.data_remessa_cn')
            ->orderBy('registo_entrada.proveniencia', 'asc')
            ->select('inscricao_advogado.*')
            ->get();
            
        return view('dashboard.areatecnica.advest-remetidoscn')->extends('layouts-new.app')->section('content');
    }
}
