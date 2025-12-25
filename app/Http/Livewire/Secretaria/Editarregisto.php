<?php

namespace App\Http\Livewire\Secretaria;

use App\Http\Controllers\ActividadesistemaController;
use App\Models\Registoentrada;
use Auth;
use Livewire\Component;

class Editarregisto extends Component
{

    public $destinatario;
    public $data_entrada;
    public $assunto;
    public $observacao;
    public $tipo_documento;
    public $proveniencia;

    public $registo;
    public $hash_registo;

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
        return view('dashboard.secretaria.editar-registo')->extends('layouts-new.app')->section('content');
    }

    public function salvar()
    {

        if ($this->assunto == '' || $this->assunto == null) {
            $this->mensagem('Digite o assunto', 'warning');
        } else if ($this->proveniencia == '' || $this->proveniencia == null) {
            $this->mensagem('Informe a proveniência', 'warning');
        } else if ($this->data_entrada == '' || $this->data_entrada == null) {
            $this->mensagem('Informe a data de entrada', 'warning');
        } else {

            $registo_antigo = Registoentrada::where('hash', $this->hash_registo)->first();

            $this->registo->assunto = $this->assunto;
            $this->registo->proveniencia = $this->proveniencia;
            $this->registo->data_entrada = $this->data_entrada;
            $this->registo->observacao = $this->observacao;
            $this->registo->destinatario = $this->destinatario;
            $this->registo->tipo_documento = $this->tipo_documento;
            $this->registo->save();

            if ($registo_antigo->assunto != $this->registo->assunto) {
                $msg = "Actualizou o assunto do registo de ($registo_antigo->assunto) para (" . $this->registo->assunto .")";
                ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_antigo->id);
            }

            if ($registo_antigo->proveniencia != $this->registo->proveniencia) {
                $msg = "Actualizou a proveniência do registo de ($registo_antigo->proveniencia) para (" . $this->registo->proveniencia .")";
                ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_antigo->id);
            }

            if ($registo_antigo->data_entrada != $this->registo->data_entrada) {
                $msg = "Actualizou a data de entrada do registo de ($registo_antigo->data_entrada) para (" . $this->registo->data_entrada . ")";
                ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_antigo->id);
            }

            if ($registo_antigo->observacao != $this->registo->observacao) {
                
                $msg = "Actualizou a observação do registo de ($registo_antigo->observacao) para (" . $this->registo->observacao .")";
                if($this->registo->observacao == null || $this->registo->observacao == ''){
                    $msg = "Removeu a observação do registo que era ($registo_antigo->observacao)";
                }
                ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_antigo->id);
            }

            if ($registo_antigo->destinatario != $this->registo->destinatario) {
                $msg = "Actualizou o destinatário do registo de ($registo_antigo->destinatario) para (" . $this->registo->destinatario .")";
                ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_antigo->id);
            }

            if ($registo_antigo->tipo_documento != $this->registo->tipo_documento) {
                $msg = "Actualizou o tipo de documento do registo de ($registo_antigo->tipo_documento) para (" . $this->registo->tipo_documento .")";
                ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_antigo->id);
            }

            $this->mensagemRefresh('Actualizações efectuadas com sucesso', 'success');

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
