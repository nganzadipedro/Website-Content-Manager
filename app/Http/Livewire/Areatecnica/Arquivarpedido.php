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
    public $advogado_atribuido;
    public $nome_advogado;
    public $cedula_advogado;
    public $telefone_advogado;
    public $email_advogado;



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

        $this->advogado_atribuido = Advogadoatribuido::where('registo_entrada_id', $this->registo->id)->first();
        
        if($this->advogado_atribuido->advogado_id != null){
            $this->nome_advogado = $this->advogado_atribuido->getadvogado->getpessoa->nome;
            $this->cedula_advogado = $this->advogado_atribuido->getadvogado->num_associado;
            $telefone = $this->advogado_atribuido->getadvogado->getpessoa->telefone1;
            if($telefone == null){
                $telefone = $this->advogado_atribuido->telefone;
            }
            $this->telefone_advogado = $telefone;
            $email = $this->advogado_atribuido->getadvogado->getpessoa->email;
            if($email == null){
                $email = $this->advogado_atribuido->email;
            }
            $this->email_advogado = $email;
        }
        else{
            $this->nome_advogado = $this->advogado_atribuido->nome_completo;
            $this->cedula_advogado = $this->advogado_atribuido->cedula;
            $this->telefone_advogado = $this->advogado_atribuido->telefone;
            $this->email_advogado = $this->advogado_atribuido->email;
        }

        return view('dashboard.areatecnica.arquivar-pedido')->extends('layouts-new.app')->section('content');
    }

    public function salvar()
    {

        if ($this->localizacao == '' || $this->localizacao == null) {
            $this->mensagem('Informe a localização onde será arquivado', 'warning');
        } else {
            $this->registo->estado = 'arquivado';
            $this->registo->save();

            $pedido = Pedidoassistencia::create([
                'hash' => Str::uuid(),
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
            return redirect()->route('system.areatecnica.listar_pedidos_pendentes');

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
