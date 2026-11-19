<?php

namespace App\Http\Livewire\Geral;

use App\Http\Controllers\ActividadesistemaController;
use App\Models\Enoaa\Ano;
use App\Models\Candidatura;
use App\Models\Fio\Candidaturaformacao;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Destacadas extends Component
{

    public $candidaturas = array();
    public $homens;
    public $mulheres;
    
    public function render()
    {
        $ano = Ano::where('estado', 'Activo')->first();
        $this->candidaturas = Candidaturaformacao::where('pintar', 'Sim')->get();
        $this->homens = 0;
        $this->mulheres = 0;

        foreach($this->candidaturas as $item){
            if($item->getPessoa->genero == 'Masculino'){
                $this->homens++;
            }
            else{
                $this->mulheres++;
            }
        }
        return view('dashboard.candidaturas.destacadas')->extends('layouts.app')->section('conteudo');
    }

    public function remover_destaque($id){

        $candidatura = Candidaturaformacao::find($id);
        $candidatura->pintar = 'Não';
        $candidatura->save();
        // gerar historico
        ActividadesistemaController::inserir(Auth::id(), "Removeu o destaque na candidatura", 'CEF', 'candidatura', $candidatura->id);
  
        $this->mensagem('Destaque removido com sucesso', 'success');
    }
}
