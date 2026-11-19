<?php

namespace App\Http\Livewire\Geral;

use App\Models\Enoaa\Ano;
use App\Models\Candidatura;
use App\Models\Fio\Candidaturaformacao;
use Auth;
use Livewire\Component;

class Aprovadas extends Component
{
    public $candidaturas = array();
    public $homens;
    public $mulheres;
    public $ano;

    public function render()
    {
        $ano = Ano::where('estado', 'Activo')->first();
        $this->candidaturas = Candidaturaformacao::where('estado', 'aprovado')->where('pago', 'não pago')->where('year_id', $ano->id)->get();
        $this->homens = 0;
        $this->mulheres = 0;

        foreach ($this->candidaturas as $item) {
            if ($item->getPessoa->genero == 'Masculino') {
                $this->homens++;
            } else {
                $this->mulheres++;
            }
        }


        if (Auth::user()->permission_id == 4) {

            $this->candidaturas = Candidaturaformacao::
                where('estado', 'aprovado')
                ->where('pago', 'não pago')
                ->where('prov_formacao_id', Auth::user()->provincia_id)
                ->get();

            $this->homens = 0;
            $this->mulheres = 0;

            foreach ($this->candidaturas as $item) {
                if ($item->getPessoa->genero == 'Masculino') {
                    $this->homens++;
                } else {
                    $this->mulheres++;
                }
            }

        }

        return view('dashboard.candidaturas.aprovadas')->extends('layouts.app')->section('conteudo');
    }
}
