<?php

namespace App\Http\Livewire\Secretaria;

use App\Models\Registoentrada;
use Auth;
use Livewire\Component;
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


        if (Auth::user()->permissao_id == 2) {
            return view('dashboard.secretaria.index')->extends('layouts-new.app')->section('content');
        } else if (Auth::user()->permissao_id == 6) {
            return view('dashboard.recepcionista.index')->extends('layouts-new.app')->section('content');
        }

    }
}
