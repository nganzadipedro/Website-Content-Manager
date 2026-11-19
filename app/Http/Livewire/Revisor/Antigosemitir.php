<?php

namespace App\Http\Livewire\Revisor;

use Livewire\Component;
use App\Models\Enoaa\Pessoa;
use App\Models\Fio\Aluno;

class Antigosemitir extends Component
{

    public $hash_aluno;
    public $aluno;
    public $pessoa;

    public function mount($hash)
    {
        $this->hash_aluno = $hash;
        $this->aluno = Aluno::where('hash', $this->hash_aluno)->first();
        $this->pessoa = Pessoa::find($this->aluno->pessoa_id);
    
    }

    public function render()
    {
        return view('dashboard.revisor.emitir-declaracao')->extends('layouts.app')->section('conteudo');
    }
}
