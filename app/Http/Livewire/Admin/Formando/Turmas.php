<?php

namespace App\Http\Livewire\Admin\Formando;

use App\Models\Fio\Candidaturaformacao;
use Auth;
use Livewire\Component;
use App\Models\Fio\Turma;

class Turmas extends Component
{


    public $turmas = array();

    public function render()
    {
        $this->turmas = Turma::all();

        if (Auth::user()->permission_id == 4) {

            $this->turmas = Turma::where('provincia_id', Auth::user()->provincia_id)
                ->get();

        }

        return view('dashboard.admin.formando.turmas')->extends('layouts.app')->section('conteudo');
    }

    public function inscritos($id_turma)
    {
        $total = Candidaturaformacao::where('turma_id', $id_turma)->count();
        return $total;
    }

}
