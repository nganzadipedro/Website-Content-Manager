<?php

namespace App\Http\Livewire\Admin;

use App\Models\Advogado;
use Livewire\Component;

class Detalhesadvogado extends Component
{

    public $hash_advogado;
    public $advogado;
    public $pessoa;

    public function mount($hash){
        $this->hash_advogado = $hash;
    }

    public function render()
    {
        $this->advogado = Advogado::where('hash', $this->hash_advogado)->first();
        $this->pessoa = $this->advogado->getpessoa;   
        return view('dashboard.admin.detalhes-advogado')->extends('layouts.main')->section('content');
    }
}
