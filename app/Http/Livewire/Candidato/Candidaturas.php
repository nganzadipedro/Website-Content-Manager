<?php

namespace App\Http\Livewire\Candidato;

use App\Models\Candidato;
use App\Models\Fio\Candidaturaformacao;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Candidaturas extends Component
{

    public $candidaturas = null;
    public $candidatura = null;

    public function render()
    {
        $id_user = Auth::user()->id;
        $user = User::find($id_user);
        $this->candidaturas = Candidaturaformacao::where('pessoa_id', $user->getPessoa->id)->get();

        return view('dashboard.candidato.candidaturas')->extends('layouts.app')->section('conteudo');
    }
}
