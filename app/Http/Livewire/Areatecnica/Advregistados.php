<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Inscricaoadvogado;
use App\Models\User;
use Livewire\Component;

class Advregistados extends Component
{

    public $lista_conselheiros;
    public $categoria_p;

    public function mount($categoria)
    {
        $this->categoria_p = $categoria;
    }
    public function render()
    {
        if ($this->categoria_p == 'Indeferido') {
            $this->lista_conselheiros = User::where('permissao_id', 5)->get();
            $this->lista = Inscricaoadvogado::where('tipo_processo_id', 2)
                ->where('despacho', 'Indeferido')
                ->orderBy('id', 'desc')->get();
        } else {
            $this->categoria_p = 'Sobre a mesa do Presidente';
            $this->lista_conselheiros = User::where('permissao_id', 5)->get();
            $this->lista = Inscricaoadvogado::where('tipo_processo_id', 2)
                ->where('estado', 'Sobre a mesa do Presidente')
                ->orderBy('id', 'desc')->get();

        }

        return view('dashboard.areatecnica.adv-registados')->extends('layouts-new.app')->section('content');

    }
}
