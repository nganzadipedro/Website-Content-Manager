<?php

namespace App\Http\Livewire\Formador;

use App\Models\Fio\Professor;
use App\Models\Fio\Professorformacao;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $turmas = array();
    public $professor;
    public function render()
    {
        $this->professor = Professor::where('pessoa_id', Auth::user()->pessoa_id)->first();
        $this->turmas = Professorformacao::where('professor_id', $this->professor->id)->get();

        return view('dashboard.formador.index')->extends('layouts.app')->section('conteudo');
    }
}
