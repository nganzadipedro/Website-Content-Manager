<?php

namespace App\Http\Livewire\Areatecnica;

use App\Http\Controllers\ActividadesistemaController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OmbalaController;
use App\Models\Inscricaoadvogado;
use App\Models\Registoentrada;
use Auth;
use \PDF;
use Livewire\Component;

class Registardespacho extends Component
{

    public $hash_pedido;
    public $registo;
    public $assunto;
    public $destinatario;
    public $data_entrada;
    public $observacao;
    public $tipo_documento;
    public $proveniencia;

    public $telefone1;
    public $telefone2;
    public $email;

    public $sexo;
    public $natureza;
    public $localizacao;
    public $observacao2;
    public $advogado_atribuido;
    public $nome_advogado;
    public $cedula_advogado;
    public $telefone_advogado;
    public $email_advogado;

    public $inscricao_advogado;

    public $mensagem_despacho;
    public $despacho;
    public $data_despacho;
    public $data_cerimonia;
    public $cedula_disponivel;
    public $data_remessa_cn;
    public $data_emissao_cedula;
    public $numero_cedula;

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
        $this->inscricao_advogado = Inscricaoadvogado::where('registo_entrada_id', $this->registo->id)->first();

        $this->data_remessa_cn = $this->inscricao_advogado->data_remessa_cn;
        $this->data_emissao_cedula = $this->inscricao_advogado->data_emissao_cedula;
        $this->numero_cedula = $this->inscricao_advogado->numero_cedula;
        $this->cedula_disponivel = $this->inscricao_advogado->cedula_disponivel;
        $this->data_cerimonia = $this->inscricao_advogado->data_cerimonia;

    }
    public function render()
    {
        return view('dashboard.areatecnica.registar-despacho')->extends('layouts-new.app')->section('content');
    }

    public function salvar()
    {

        if ($this->despacho == null || $this->despacho == '') {
            $this->mensagem('O campo despacho é obrigatório', 'warning');
        } else if ($this->data_despacho == null || $this->data_despacho == '') {
            $this->mensagem('O campo data do despacho é obrigatório', 'warning');
        } else if ($this->despacho == 'Indeferido' && ($this->mensagem_despacho == null || $this->mensagem_despacho == '')) {
            $this->mensagem('O campo mensagem do despacho é obrigatório quando o despacho é indeferido', 'warning');
        } else {
            if ($this->despacho == 'Deferido') {

                $this->inscricao_advogado->texto_despacho = $this->mensagem_despacho;
                $this->inscricao_advogado->despacho = $this->despacho;
                $this->inscricao_advogado->data_despacho = $this->data_despacho;
                $this->inscricao_advogado->save();

                $this->registo->estado = 'deferido';
                $this->registo->save();

                $telefone = $this->inscricao_advogado->telefone1;
                $obmsg = new OmbalaController();
                $obmsg->enviarMensagem($telefone, "Caríssimo(a), saudações. Já foi emitido um despacho para o seu processo de inscrição.");

            } else if ($this->despacho == 'Indeferido') {

                $this->inscricao_advogado->texto_despacho = $this->mensagem_despacho;
                $this->inscricao_advogado->despacho = $this->despacho;
                $this->inscricao_advogado->data_despacho = $this->data_despacho;
                $this->inscricao_advogado->save();

                $nome = $this->registo->proveniencia;
                $email = $this->inscricao_advogado->email;
                $telefone = $this->inscricao_advogado->telefone1;
                $data_despacho = $this->data_despacho;
                $ob = new MailController();
                $obmsg = new OmbalaController();
                $obmsg->enviarMensagem($telefone, "Caríssimo(a), saudações. Já foi emitido um despacho para o seu processo de inscrição.");
                $ob->mailDespacho($email, $nome, $this->mensagem_despacho, $data_despacho);

            }

            $msg = "Processo de inscrição despachado como $this->despacho, com a seguinte mensagem: $this->mensagem_despacho";
            ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $this->registo->id);
            $msg = "Registou a emissão de despacho para o processo de inscrição.";
            ActividadesistemaController::inserir(Auth::id(), $msg, 'user', $this->registo->id);

            $this->mensagemRefresh('Despacho registado com sucesso e notificação enviada ao advogado.', 'success');
        }

    }

    public function actualizar_dados()
    {

        if ($this->data_remessa_cn != null && $this->cedula_disponivel == 'Sim' && ($this->numero_cedula == null || $this->numero_cedula == '')) {
            $this->mensagem('Por favor, insira o número da cédula.', 'warning');
        } else if ($this->data_remessa_cn != null && $this->cedula_disponivel == 'Sim' && ($this->data_emissao_cedula == null || $this->data_emissao_cedula == '')) {
            $this->mensagem('Por favor, insira a data de emissão da cédula.', 'warning');
        } else {
            $registo_inscricao_old = Inscricaoadvogado::where('registo_entrada_id', $this->registo->id)->first();
            if ($registo_inscricao_old->data_remessa_cn != $this->inscricao_advogado->data_remessa_cn) {
                $msg = "Actualizou a data de remessa para o CN ($this->data_remessa_cn).";
                ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_inscricao_old->id);
            }
            if ($registo_inscricao_old->data_emissao_cedula != $this->inscricao_advogado->data_emissao_cedula) {
                $msg = "Actualizou a data de emissão da cédula ($this->data_emissao_cedula).";
                ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_inscricao_old->id);
            }
            if ($registo_inscricao_old->numero_cedula != $this->inscricao_advogado->numero_cedula) {
                $msg = "Actualizou o número da cédula ($this->numero_cedula).";
                ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_inscricao_old->id);
            }
            if ($registo_inscricao_old->cedula_disponivel != $this->inscricao_advogado->cedula_disponivel) {
                $msg = "Actualizou o estado de disponibilidade da cédula.";
                ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_inscricao_old->id);
            }
            if ($registo_inscricao_old->data_cerimonia != $this->inscricao_advogado->data_cerimonia) {
                $msg = "Actualizou a data da cerimónia ($this->data_cerimonia).";
                ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_inscricao_old->id);
            }

            $this->inscricao_advogado->data_remessa_cn = $this->data_remessa_cn;
            $this->inscricao_advogado->data_emissao_cedula = $this->data_emissao_cedula;
            $this->inscricao_advogado->numero_cedula = $this->numero_cedula;
            $this->inscricao_advogado->cedula_disponivel = $this->cedula_disponivel;
            $this->inscricao_advogado->data_cerimonia = $this->data_cerimonia;
            $this->inscricao_advogado->save();

            $this->mensagemRefresh('Dados actualizados com sucesso', 'success');

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
