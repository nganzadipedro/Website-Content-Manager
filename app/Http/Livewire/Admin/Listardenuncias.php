<?php

namespace App\Http\Livewire\Admin;

use App\Models\Denuncia;
use Livewire\Component;

class Listardenuncias extends Component
{

    public $lista_denuncias;
    public $tipo_form;

    public function mount($tipo){
        $this->tipo_form = $tipo;
    }

    public function render()
    {
        if ($this->tipo_form == 'solved') {
            $this->lista_denuncias = Denuncia::where('estado', 'atendida')->orderBy('updated_at', 'desc')->get();
            return view('dashboard.admin.listar-denuncias')->extends('layouts.main')->section('content');
        } else {
            $this->lista_denuncias = Denuncia::where('estado', 'pendente')->orderBy('id', 'asc')->get();
            return view('dashboard.admin.listar-denuncias-pendentes')->extends('layouts.main')->section('content');
        }
    }
}
