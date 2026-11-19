<?php

namespace App\Http\Livewire\Areatecnica;

use App\Http\Controllers\ActividadesistemaController;
use App\Models\Advogadoatribuido;
use App\Models\Pedidoassistencia;
use App\Models\Registoentrada;
use Illuminate\Support\Str;
use Auth;
use Livewire\Component;

class Arquivarpedido extends Component
{

    public $hash_pedido;
    public $hash_registo;
    public $registo;
    public $assunto;
    public $destinatario;
    public $data_entrada;
    public $observacao;
    public $tipo_documento;
    public $proveniencia;
    public $pedido;

    public $sexo;
    public $natureza;
    public $localizacao;
    public $observacao2;
    public $advogados = array();

    public function mount($hash)
    {

        $this->hash_pedido = $hash;
        $this->pedido = Pedidoassistencia::where('hash', $this->hash_pedido)->first();
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
        return view('dashboard.areatecnica.arquivar-pedido')->extends('layouts-new.app')->section('content');
    }

    public function salvar()
    {

        if ($this->localizacao == '' || $this->localizacao == null) {
            $this->mensagem('Informe a localização onde será arquivado', 'warning');
        } else {
            $this->registo->estado = 'arquivado';
            $this->registo->save();

            $numero = Pedidoassistencia::whereYear('created_at', now()->year)->count() + 1;

            $pedido = Pedidoassistencia::create([
                'hash' => Str::uuid(),
                'numero' => $numero,
                'codigo' => $numero . '/' . now()->year,
                'observacao' => $this->observacao2,
                'sexo' => $this->sexo == null ? 'Não Definido' : $this->sexo,
                'natureza' => $this->natureza == null ? 'Não Definido' : $this->natureza,
                'localizacao' => $this->localizacao,
                'registo_entrada_id' => $this->registo->id,
                'user_id' => Auth::user()->id
            ]);

            $msg = "Pedido de assistência arquivado pela Área Técnica.";
            ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $this->registo->id);
            ActividadesistemaController::inserir(Auth::id(), "Arquivou o pedido de assistência jurídica ($pedido->id)", 'user', $pedido->id);
            $this->mensagem($msg, 'success');
            return redirect()->route('system.areatecnica.listar_pedidos_arquivados');

        }

    }

    private function mensagem($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal2', [
            'title' => '',
            'text' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            'toast' => false,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'center'
        ]);
    }

    private function mensagemRefresh($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal', [
            'title' => '',
            'text' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            'toast' => false,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'center'
        ]);
    }
}
