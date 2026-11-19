<?php

namespace App\Http\Livewire\Geral;

use App\Models\Enoaa\Ano;
use App\Models\Fio\Candidaturaformacao;
use Auth;
use Livewire\Component;

class Todascandidaturas extends Component
{


    public $candidaturas = array();
    public $homens;
    public $mulheres;
    public $ano_select;
    public $ano_id;
    public $lista_filtro = null;
    public $lista_anos = array();

    public function mount($ano)
    {
        $this->ano_id = $ano;
    }

    public function render()
    {

        $this->lista_anos = Ano::all();
        $this->ano_select = Ano::find($this->ano_id);
        $this->candidaturas = Candidaturaformacao::where('year_id', $this->ano_id)->get();

        if (Auth::user()->permission_id == 4) {
            $this->candidaturas = Candidaturaformacao::where('year_id', $this->ano_id)
                ->where('prov_formacao_id', Auth::user()->provincia_id)
                ->get();
        }

        $this->homens = 0;
        $this->mulheres = 0;

        if (count($this->candidaturas) > 0) {
            foreach ($this->candidaturas as $item) {
                if ($item->getPessoa->genero == 'Masculino') {
                    $this->homens++;
                } else {
                    $this->mulheres++;
                }
            }
        }

        return view('dashboard.candidaturas.todas')->extends('layouts.app')->section('conteudo');

    }
}
