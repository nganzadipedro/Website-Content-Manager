<?php

namespace App\Http\Livewire\Admin;

use App\Models\Registoentrada;
use Livewire\Component;

class Listarassistencia extends Component
{

    public $tipo;
    public $lista = array();

    public function mount($tipo)
    {
        $this->tipo = $tipo;
    }
    public function render()
    {
        if ($this->tipo == 'not-solved') {
            $this->lista = Registoentrada::where('encaminhado', 'Presidente')
            ->orWhere('encaminhado', 'Conselheiro')
            ->where('tipo_processo_id', 1)->where('estado','pendente')->get();
            return view('dashboard.admin.aj-pendentes')->extends('layouts-new.app')->section('content');
        } elseif ($this->tipo == 'solved') {
             $this->lista = Registoentrada::where('encaminhado', 'Área Técnica')
            ->where('tipo_processo_id', 1)->get();
            return view('dashboard.admin.aj-deferidos')->extends('layouts-new.app')->section('content');
        }
    }
}
