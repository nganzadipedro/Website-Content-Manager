<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Municipio;
use App\Models\Pessoa;
use App\Models\Platform\Advogado;
use Livewire\Component;

class Editarassociado extends Component
{

    public $advogado;
    public $membro_hash;
    public $pessoa;
    public $municipios;

    public function mount($hash)
    {
        $this->membro_hash = $hash;
        $this->advogado = Advogado::where('hash', $this->membro_hash)->first();
        $this->pessoa = Pessoa::find($this->advogado->pessoa_id);
    }

    public function render()
    {
         $this->municipios = Municipio::all();
        return view('dashboard.areatecnica.editar-associado')->extends('layouts-new.app')->section('content');
    }
}
