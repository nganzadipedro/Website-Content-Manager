<?php

namespace App\Http\Livewire\Secretaria;

use App\Http\Controllers\ActividadesistemaController;
use App\Models\Registoentrada;
use App\Models\Tipoprocesso;
use Auth;
use Livewire\Component;

class Registarentrada extends Component
{

    public $destinatario;
    public $data_entrada;
    public $assunto;
    public $observacao;
    public $tipo_processo_id;
    public $tipo_documento;
    public $outro_tipo_processo;
    public $telefone;
    public $titulo;
    public $outro_titulo;
    public $proveniencia;

    public $tipos_processo = array();

    public function render()
    {
        $this->tipos_processo = Tipoprocesso::all();
        return view('dashboard.secretaria.registar-entrada')->extends('layouts-new.app')->section('content');
    }

    public function salvar()
    {


        if ($this->assunto == '' || $this->assunto == null) {
            $this->mensagem('Digite o assunto', 'warning');
        } else if ($this->tipo_processo_id == '' || $this->tipo_processo_id == null) {
            $this->mensagem('Escolha o tipo de processo', 'warning');
        } else if ($this->proveniencia == '' || $this->proveniencia == null) {
            $this->mensagem('Informe a proveniência', 'warning');
        } else if ($this->titulo == '' || $this->titulo == null) {
            $this->mensagem('Informe o título/função', 'warning');
        } else if ($this->titulo == 'Outro' && ($this->outro_titulo == null || $this->outro_titulo == '')) {
            $this->mensagem('Informe o título/função', 'warning');
        } else if ($this->data_entrada == '' || $this->data_entrada == null) {
            $this->mensagem('Informe a data de entrada', 'warning');
        } else if ($this->tipo_processo_id == 9 && ($this->outro_tipo_processo == null || $this->outro_tipo_processo == '')) {
            $this->mensagem('Informe o outro tipo de processo', 'warning');
        } else {

            date_default_timezone_set("Africa/Luanda");

            $numero = Registoentrada::whereYear('created_at', now()->year)->count() + 1;

            $registo = Registoentrada::create([
                'assunto' => $this->assunto,
                'proveniencia' => $this->proveniencia,
                'data_entrada' => $this->data_entrada,
                'observacao' => $this->observacao,
                'telefone' => $this->telefone,
                'titulo' => $this->titulo == 'Outro' ? $this->outro_titulo : $this->titulo,
                'tipo_processo_id' => $this->tipo_processo_id,
                'outro_tipo_processo' => $this->tipo_processo_id != 9 ? '' : $this->outro_tipo_processo,
                'destinatario' => $this->destinatario == null ? 'CPL-OAA' : $this->destinatario,
                'tipo_documento' => $this->tipo_documento == null ? 'Requerimento' : $this->tipo_documento,
                'user_id' => Auth::user()->id
            ]);

            $registo->hash = md5($registo->created_at . $registo->id . $registo->user_id);
            $registo->numero = $numero;
            $registo->save();
            $registo->codigo = "$numero/" . now()->year;
            $registo->save();

            ActividadesistemaController::inserir(Auth::id(), "Registo de entrada do processo na secretária ($registo->assunto)", 'registo-entrada', $registo->id);
            ActividadesistemaController::inserir(Auth::id(), "Registou uma entrada de processo na secretária ($registo->assunto)", 'user', Auth::id());

            $this->mensagemRefresh('Registo efectuado com sucesso', 'success');

            return redirect()->route('system.secretaria.listar_registos');

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
