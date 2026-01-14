<?php

namespace App\Http\Livewire\Secretaria;

use App\Models\Registoentrada;
use Livewire\Component;

class Gerarrelatorio extends Component
{

    public $data_inicial;
    public $data_final;
    public $res = array();

    public function render()
    {
        return view('dashboard.secretaria.relatorios')->extends('layouts-new.app')->section('content');
    }

    public function get_data_report()
    {

        $data1 = $this->data_inicial . " 00:00:00";
        $data2 = $this->data_final . " 23:59:59";

        $this->res[0] = Registoentrada::where('tipo_processo_id', 1)
            ->whereBetween('created_at', [$data1, $data2])
            ->count();

        $this->res[1] = Registoentrada::where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$data1, $data2])
            ->count();

        $this->res[2] = Registoentrada::where('tipo_processo_id', 3)
            ->whereBetween('created_at', [$data1, $data2])
            ->count();

    }
}
