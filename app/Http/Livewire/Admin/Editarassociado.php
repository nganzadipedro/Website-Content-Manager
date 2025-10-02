<?php

namespace App\Http\Livewire\Admin;

use App\Models\Platform\Advogado;
use Livewire\Component;

class Editarassociado extends Component
{

    public $membro_hash;
    public $advogado;

    public function mount($hash)
    {
        $this->membro_hash = $hash;
        $this->advogado = Advogado::where('hash', $this->membro_hash)->first();
    }

    public function render()
    {
        return view('dashboard.admin.editar-advogado')->extends('layouts.main')->section('content');
    }
}
