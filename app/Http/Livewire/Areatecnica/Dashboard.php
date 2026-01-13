<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Inscricaoadvogado;
use App\Models\Pedidoassistencia;
use Livewire\Component;
use App\Models\Registoentrada;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $registos_entrada;
    public $inscricao_advogados;
    public $inscricao_estagiarios;
    public $vetor_registos = array();

    public function render()
    {

        $inicioSemana = Carbon::now()->startOfWeek(); // segunda-feira
        $fimSemana = Carbon::now()->endOfWeek();      // domingo

        $mesAtual = Carbon::now()->month;
        $anoAtual = Carbon::now()->year;

        $this->registos_entrada = Pedidoassistencia::count();
        $this->inscricao_advogados = Inscricaoadvogado::where('tipo_processo_id', 2)->count();
        $this->inscricao_estagiarios = Inscricaoadvogado::where('tipo_processo_id', 3)->count();

        $this->registos_entrada = Pedidoassistencia::count();
        $this->vetor_registos[0] = Pedidoassistencia::whereBetween('created_at', [$inicioSemana, $fimSemana])->count();
        $this->vetor_registos[1] = Pedidoassistencia::whereMonth('created_at', $mesAtual)
            ->whereYear('created_at', $anoAtual)
            ->count();
        $this->vetor_registos[2] = Pedidoassistencia::whereYear('created_at', $anoAtual)
            ->count();

        // inscrições de advogados
        $this->vetor_registos[3] = Inscricaoadvogado::where('tipo_processo_id', 2)->whereBetween('created_at', [$inicioSemana, $fimSemana])->count();
        $this->vetor_registos[4] = Inscricaoadvogado::where('tipo_processo_id', 2)->whereMonth('created_at', $mesAtual)
            ->whereYear('created_at', $anoAtual)
            ->count();
        $this->vetor_registos[5] = Inscricaoadvogado::where('tipo_processo_id', 2)->whereYear('created_at', $anoAtual)
            ->count();

        // inscrições de advogados estagiários
        $this->vetor_registos[6] = Inscricaoadvogado::where('tipo_processo_id', 3)->whereBetween('created_at', [$inicioSemana, $fimSemana])->count();
        $this->vetor_registos[7] = Inscricaoadvogado::where('tipo_processo_id', 3)->whereMonth('created_at', $mesAtual)
            ->whereYear('created_at', $anoAtual)
            ->count();
        $this->vetor_registos[8] = Inscricaoadvogado::where('tipo_processo_id', 3)->whereYear('created_at', $anoAtual)
            ->count();


        return view('dashboard.areatecnica.index')->extends('layouts-new.app')->section('content');

    }
}
