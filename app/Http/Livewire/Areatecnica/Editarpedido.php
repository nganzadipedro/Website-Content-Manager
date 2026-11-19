<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Advogadoatribuido;
use App\Models\Pedidoassistencia;
use App\Models\Registoentrada;
use Livewire\Component;

class Editarpedido extends Component
{
    public $pedido;
    public $hash_p;
    public $hash_pedido;
    public $hash_registo;
    public $registo;
    public $assunto;
    public $destinatario;
    public $data_entrada;
    public $observacao;
    public $tipo_documento;
    public $proveniencia;

    public $sexo;
    public $natureza;
    public $localizacao;
    public $observacao2;
    public $advogados = array();

    public function mount($hash)
    {
        $this->hash_p = $hash;
        $this->pedido = Pedidoassistencia::where('hash', $this->hash_p)->first();
        $this->registo = Registoentrada::find($this->pedido->registo_entrada_id);
        $this->assunto = $this->registo->assunto;
        $this->destinatario = $this->registo->destinatario;
        $this->data_entrada = $this->registo->data_entrada;
        $this->observacao = $this->registo->observacao;
        $this->tipo_documento = $this->registo->tipo_documento;
        $this->proveniencia = $this->registo->proveniencia;
    }
    public function render()
    {
        $this->advogados = Advogadoatribuido::where('registo_entrada_id', $this->registo->id)->get();
        return view('dashboard.areatecnica.editar-pedido')->extends('layouts-new.app')->section('content');
    }
}
