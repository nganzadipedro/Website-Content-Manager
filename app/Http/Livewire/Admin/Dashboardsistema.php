<?php

namespace App\Http\Livewire\Admin;

use App\Models\Platform\Advogado;
use App\Models\User;
use Livewire\Component;

class Dashboardsistema extends Component
{

    public $vetor_dados = array();

    public function render()
    {

        $this->vetor_dados[0] = Advogado::where('categoria', 'Advogado')->count();
        $this->vetor_dados[1] = Advogado::where('categoria', 'Estagiario')->count();
        $this->vetor_dados[2] = User::where('permissao_id', '!=',3)->count();

        return view('dashboard.admin.index-system')->extends('layouts.main')->section('content');

    }
}
