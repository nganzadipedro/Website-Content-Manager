<?php

namespace App\Http\Livewire\Areatecnica;

use Livewire\Component;
use App\Models\Registoentrada;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $registos_entrada;
    public $vetor_registos = array();

    public function render()
    {

        $inicioSemana = Carbon::now()->startOfWeek(); // segunda-feira
        $fimSemana = Carbon::now()->endOfWeek();      // domingo

        $mesAtual = Carbon::now()->month;
        $anoAtual = Carbon::now()->year;

        $this->registos_entrada = Registoentrada::count();
        $this->vetor_registos[0] = Registoentrada::whereBetween('created_at', [$inicioSemana, $fimSemana])->count();
        $this->vetor_registos[1] = Registoentrada::whereMonth('created_at', $mesAtual)
            ->whereYear('created_at', $anoAtual)
            ->count();
        $this->vetor_registos[2] = Registoentrada::whereYear('created_at', $anoAtual)
            ->count();


        return view('dashboard.areatecnica.index')->extends('layouts-new.app')->section('content');

    }
}
