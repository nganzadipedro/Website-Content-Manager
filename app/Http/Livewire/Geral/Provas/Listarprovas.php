<?php

namespace App\Http\Livewire\Geral\Provas;

use App\Models\Fio\Disciplina;
use App\Models\Fio\Perguntaprova;
use App\Models\Fio\Professor;
use App\Models\Fio\Professorformacao;
use App\Models\Fio\Prova;
use App\Models\Fio\Turma;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Listarprovas extends Component
{
    public function render()
    {
        $this->professor = Professor::where('pessoa_id', Auth::user()->pessoa_id)->first();
        $this->lista = Prova::where('professor_id', $this->professor->id)->orderBy('id', 'desc')->get();
        return view('dashboard.provas.listar')->extends('layouts.app')->section('conteudo');
    }
}
