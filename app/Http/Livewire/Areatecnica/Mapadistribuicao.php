<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Inscricaoadvogado;
use App\Models\User;
use Livewire\Component;

class Mapadistribuicao extends Component
{

    public $categoria_p;

    public function mount($categoria)
    {
        $this->categoria_p = $categoria;
    }
    public function render()
    {
        if ($this->categoria_p == 'stage-one') {

            // por distribuir aos conselheiros
            $this->lista_conselheiros = User::where('permissao_id', 5)->get();
            $this->lista = Inscricaoadvogado::where('tipo_processo_id', 2)
                ->where('estado_distribuicao', 'Por Distribuir')
                ->orderBy('id', 'desc')->get();
            return view('dashboard.areatecnica.mapa-distribuicao')->extends('layouts-new.app')->section('content');
        } else if ($this->categoria_p == 'stage-two') {

            // remetidos aos conselheiros
            $this->lista = Inscricaoadvogado::where('tipo_processo_id', 2)
                ->where('estado_distribuicao', 'Distribuido')
                ->whereNull('data_levantamento_comissao_etica')
                ->orWhere('estado', 'análise de conselheiro')
                ->orderBy('id', 'desc')->get();

            return view('dashboard.areatecnica.remetidos-conselheiro')->extends('layouts-new.app')->section('content');

        } else if ($this->categoria_p == 'stage-three') {

            // remetidos aos conselheiros
            $this->lista = Inscricaoadvogado::where('tipo_processo_id', 2)
                ->whereNotNull('data_levantamento_comissao_etica')
                ->whereNull('data_entrega_comissao_etica')
                ->where('estado', 'análise comissão de ética')
                ->orderBy('id', 'desc')->get();

            return view('dashboard.areatecnica.remetidos-comissao-etica')->extends('layouts-new.app')->section('content');

        }

    }
}
