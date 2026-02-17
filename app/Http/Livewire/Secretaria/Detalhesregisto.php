<?php

namespace App\Http\Livewire\Secretaria;

use App\Models\Anexosregisto;
use App\Models\Historicosistema;
use App\Models\Inscricaoadvogado;
use App\Models\Pedidoassistencia;
use App\Models\Platform\Advogado;
use App\Models\Registoentrada;
use Auth;
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

    public $pedido_assistencia;
    public $inscricao_advogado;

    public $historico_registo = array();
    public $anexos_registo = array();
    public $lista_advogados = array();
    public $arquivado;

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
        $this->pedido_assistencia = Pedidoassistencia::where('registo_entrada_id', $this->registo->id)->first();
        $this->inscricao_advogado = Inscricaoadvogado::where('registo_entrada_id', $this->registo->id)->first();

        if (Auth::user()->permissao_id == 3) {
            return view('dashboard.areatecnica.detalhes-registos')->extends('layouts-new.app')->section('content');
        } else if (Auth::user()->permissao_id == 2) {
            return view('dashboard.secretaria.detalhes-registos')->extends('layouts-new.app')->section('content');
        }
        else if (Auth::user()->permissao_id == 6) {
            return view('dashboard.recepcionista.detalhes-registos')->extends('layouts-new.app')->section('content');
        }
        else if (Auth::user()->permissao_id == 1 || Auth::user()->permissao_id == 5) {
            $this->lista_advogados = Advogado::where('categoria', 'Advogado')->get();
            return view('dashboard.admin.detalhes-registos')->extends('layouts-new.app')->section('content');
        }

    }
}
