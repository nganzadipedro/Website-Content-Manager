<?php

namespace App\Http\Livewire\Secretaria;

use App\Models\Anexosregisto;
use App\Models\Historicosistema;
use App\Models\Registoentrada;
use Livewire\Component;

class Detalhesregisto extends Component
{


    public $destinatario;
    public $data_entrada;
    public $assunto;
    public $observacao;
    public $tipo_documento;
    public $proveniencia;
    public $registo;
    public $hash_registo;

    public $historico_registo = array();
    public $anexos_registo = array();

    public function mount($hash)
    {

        $this->hash_registo = $hash;
        $this->registo = Registoentrada::where('hash', $this->hash_registo)->first();

        $this->assunto = $this->registo->assunto;
        $this->destinatario = $this->registo->destinatario;
        $this->data_entrada = $this->registo->data_entrada;
        $this->observacao = $this->registo->observacao;
        $this->tipo_documento = $this->registo->tipo_documento;
        $this->proveniencia = $this->registo->proveniencia;

    }

    public function render()
    {

        $this->historico_registo = Historicosistema::where('destino', 'registo-entrada')
            ->where('destino_id', $this->registo->id)
            ->orderBy('id', 'desc')
            ->get();

            $this->anexos_registo = Anexosregisto::where('registo_id', $this->registo->id)->get();
            
        return view('dashboard.secretaria.detalhes-registos')->extends('layouts-new.app')->section('content');

    }
}
