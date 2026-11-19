<?php

namespace App\Http\Livewire\Geral;

use App\Models\Fio\Actividadesistema as FioActividadesistema;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Actividadesistema extends Component
{

    public $lista_actividades = array();

    public function render()
    {

        if(Auth::user()->permission_id == 1){
            $this->lista_actividades = FioActividadesistema::orderBy('id', 'desc')->get();
       
        }
        else{
            $this->lista_actividades = FioActividadesistema::where("user_id", Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();
        }

        return view('auth.actividades')
        ->extends('layouts.app')
        ->section('conteudo');
    }
}
