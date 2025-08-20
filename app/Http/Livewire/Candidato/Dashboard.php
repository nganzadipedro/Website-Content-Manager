<?php

namespace App\Http\Livewire\Candidato;

use App\Models\Candidato;
use App\Models\Candidatura;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Pessoa;
use App\Models\Provincia;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{

    public $candidatura;

    public function render()
    {

        // $candidato = Candidato::where('pessoa_id', Auth::user()->pessoa_id)->first();
        $this->candidatura = Candidaturaformacao::where('pessoa_id', Auth::user()->pessoa_id)->first();
       // dd( $this->candidatura);

        return view('dashboard.candidato.index')->extends('layouts.app')->section('conteudo');
    }
}
