<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Municipio;
use App\Models\Patrono;
use App\Models\Pessoa;
use App\Models\Platform\Advogado;
use Livewire\Component;

class Editarpatrono extends Component
{

    public $advogado;
    public $patrono;
    public $patrono_hash;
    public $pessoa;
    public $municipios;

    public function mount($hash)
    {
        $this->patrono_hash = $hash;
        $this->patrono = Patrono::where('hash', $this->patrono_hash)->first();
        if ($this->patrono->advogado_id != null) {
            $this->advogado = Advogado::find($this->patrono->advogado_id);
            $this->pessoa = Pessoa::find($this->advogado->pessoa_id);
        }
    }

    public function render()
    {
        $this->municipios = Municipio::all();
        return view('dashboard.areatecnica.editar-patrono')->extends('layouts-new.app')->section('content');
    }
}
