<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Estagiariospatrono;
use App\Models\Municipio;
use App\Models\Patrono;
use App\Models\Pessoa;
use App\Models\Platform\Advogado;
use Auth;
use Livewire\Component;

class Editarassociado extends Component
{

    public $advogado;
    public $membro_hash;
    public $pessoa;
    public $municipios;
    public $patrono;

    public $patronos = array();
    public $lista_patronos = array();

    public function mount($hash)
    {
        $this->membro_hash = $hash;
        $this->advogado = Advogado::where('hash', $this->membro_hash)->first();
        $this->pessoa = Pessoa::find($this->advogado->pessoa_id);
    }

    public function render()
    {

        $this->patronos = Patrono::all();
        foreach ($this->patronos as $pat) {
            $registo = [];
            $registo[0] = $pat->id;
            $registo[1] = $pat->advogado_id;
            $registo[2] = $pat->getadvogado->getpessoa->nome;

            array_push($this->lista_patronos, $registo);
        }

        if ($this->advogado->categoria == 'Estagiario') {
            $existe = Estagiariospatrono::where('estagiario_id', $this->advogado->id)->first();
            if ($existe != null) {
                $this->patrono = Patrono::find($existe->patrono_id);
            }
        }

        $this->municipios = Municipio::all();
        if (Auth::user()->permissao_id == 3) {
            return view('dashboard.areatecnica.editar-associado')->extends('layouts-new.app')->section('content');
        }

        return view('dashboard.secretaria.editar-associado')->extends('layouts-new.app')->section('content');

    }
}
