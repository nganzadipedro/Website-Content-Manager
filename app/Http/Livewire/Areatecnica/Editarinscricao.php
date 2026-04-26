<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Inscricaoadvogado;
use App\Models\Municipio;
use App\Models\Patrono;
use App\Models\Registoentrada;
use Livewire\Component;

class Editarinscricao extends Component
{

    public $hash_registo;
    public $registo;
    public $inscricao;
    public $municipios = array();
    public $patronos = array();
    public $patrono;

    public function mount($hash)
    {

        $this->hash_registo = $hash;
        $this->registo = Registoentrada::where('hash', $this->hash_registo)->first();
        $this->inscricao = Inscricaoadvogado::where('registo_entrada_id', $this->registo->id)->first();
        $this->assunto = $this->registo->assunto;
        $this->destinatario = $this->registo->destinatario;
        $this->data_entrada = $this->registo->data_entrada;
        $this->observacao = $this->registo->observacao;
        $this->tipo_documento = $this->registo->tipo_documento;
        $this->proveniencia = $this->registo->proveniencia;
        $this->patrono = Patrono::find($this->inscricao->patrono_id);

    }

    public function render()
    {
        $this->municipios = Municipio::all();
        $this->patronos = Patrono::all();
       
        if ($this->registo->tipo_processo_id == 3) {
            return view('dashboard.areatecnica.editar-inscricao-estagiario')->extends('layouts-new.app')->section('content');
        }
        return view('dashboard.areatecnica.editar-inscricao')->extends('layouts-new.app')->section('content');
    }
}
