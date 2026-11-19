<?php

namespace App\Http\Livewire\Juri;

use App\Models\Ano;
use App\Models\Candidatura;
use App\Models\Examecandidato;
use Livewire\Component;

class Dashboard extends Component
{

    public $total = array();
    public $candidaturas = array();


    public function render()
    {
        $ano = Ano::where('estado', 'Activo')->first();
        $conta = Candidatura::where('year_id', $ano->id)->count();
        $this->total[0] = $conta;
        $conta = Candidatura::where('year_id', $ano->id)
            ->where('estado', 'pendente')->count();
        $this->total[1] = $conta;
        $conta = Candidatura::where('year_id', $ano->id)
            ->where('estado', 'suspenso')->count();
        $this->total[2] = $conta;
        $conta = Candidatura::where('year_id', $ano->id)
            ->where('estado', 'aprovado')
            ->where('pago', 'não pago')->count();
        $this->total[3] = $conta;
        $conta = Candidatura::where('year_id', $ano->id)
            ->where('estado', 'aprovado')
            ->where('pago', 'pago')->count();
        $this->total[4] = $conta;

        $conta = Examecandidato::where('year_id', $ano->id)
        ->where('estado', 'terminado')
        ->count();
        $this->total[5] = $conta;

        $this->candidaturas = Candidatura::where('estado', 'pendente')
        ->where('year_id', $ano->id)
        ->orderBy('id', 'asc')
        ->limit(10)->get();

        return view('dashboard.juri.index')->extends('layouts.app')->section('conteudo');
    }
}
