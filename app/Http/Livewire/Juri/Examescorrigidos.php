<?php

namespace App\Http\Livewire\Juri;

use App\Models\Ano;
use App\Models\Examecandidato;
use Livewire\Component;

class Examescorrigidos extends Component
{

    public $exames;
    public $homens;
    public $mulheres;

    public function render()
    {
        $ano = Ano::where('estado', 'Activo')->first();
        $this->exames = Examecandidato::where('year_id', $ano->id)->where('estado', 'terminado')->get();
        $this->homens = 0;
        $this->mulheres = 0;

        foreach($this->exames as $item){
            if($item->candidato->getPessoa->genero == 'Masculino'){
                $this->homens++;
            }
            else{
                $this->mulheres++;
            }
        }
        
        return view('dashboard.juri.corrigidos')->extends('layouts.app')->section('conteudo');
    }
}
