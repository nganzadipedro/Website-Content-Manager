<?php

namespace App\Http\Livewire\Geral;

use App\Http\Controllers\ActividadesistemaController;
use App\Http\Controllers\ProxyPayController;
use App\Models\Fio\Candidaturaformacao;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;

class Novareferencia extends Component
{

    public $codigo;
    public $candidatura = null;
    public $nome_candidato = '';
    public $num_documento = '';
    public $estado = '';
    public $referencia_antiga = '';
    public $tem = false;
    public $total = 0;

    public function render()
    {
        $this->total = Candidaturaformacao::where('estado', 'aprovado')->count();
        return view('dashboard.candidaturas.nova-referencia')->extends('layouts.app')->section('conteudo');
    }

    function verificar()
    {
        if ($this->codigo == null || $this->codigo == '') {
            $this->mensagem('Digite o código do candidato', 'warning');
        } else {
            $this->candidatura = Candidaturaformacao::where('codigo', $this->codigo)
                ->first();

            if ($this->candidatura == null) {
                $this->mensagem('candidatura inexistente', 'warning');
                $this->tem = false;
            } else {
                $this->tem = true;
                $this->nome_candidato = $this->candidatura->getPessoa->nome;
                $this->num_documento = $this->candidatura->getPessoa->num_documento;
                $this->estado = $this->candidatura->estado;
                $this->referencia_antiga = $this->candidatura->referencia;
            }
        }
    }

    function atribuir_nova()
    {
        if ($this->candidatura == null || $this->candidatura == '') {
            $this->mensagem('Não foi selecionado nenhum candidato', 'warning');
            $this->tem = false;
            $this->nome_candidato = '';
            $this->num_documento = '';
            $this->estado = '';
            $this->referencia_antiga = '';
            $this->candidatura == null;
        } else {

            if ($this->candidatura->estado == 'pendente' || $this->candidatura->estado == 'suspenso') {
                $this->mensagem('Candidaturas pendentes e suspensas não podem receber referência de pagamento', 'warning');
            } else if ($this->candidatura->estado == 'aprovado' && $this->candidatura->pago == 'pago') {
                $this->mensagem('Esta candidatura já foi paga', 'warning');
            } else {

                $valor = 70000;
                $referencia = '';

                $tel = $this->candidatura->getPessoa->telefone1;
                $email = $this->candidatura->getPessoa->email;
                $nome = $this->candidatura->getPessoa->nome;
             
                $ob = new ProxyPayController();
                $referencia = $ob->gerarReferencia($tel, $email, $nome, $valor);

                $today = Carbon::today();
                $data_expiracao = $today->addDays(3);

                $this->candidatura->estado = 'aprovado';
                $this->candidatura->pintar = 'Não';
                $this->candidatura->referencia = $referencia;
                $this->candidatura->pago = 'não pago';
                $this->candidatura->validade_referencia = $data_expiracao;
                $this->candidatura->save();

                ActividadesistemaController::inserir(Auth::id(), "Gerou uma nova referência para o candidato $nome", 'CEF', 'candidatura', $this->candidatura->id);

                // regista actividade do sistema
                ActividadesistemaController::inserir(null, "Enviou uma nova referência de pagamento($referencia) por SMS", 'Sistema', 'candidatura', $this->candidatura->id);

                $this->mensagem('Nova referência enviada com sucesso', 'success');
                $this->tem = false;
                $this->nome_candidato = '';
                $this->num_documento = '';
                $this->estado = '';
                $this->codigo = '';
                $this->referencia_antiga = '';
                $this->candidatura == null;
            }
        }
    }

    private function mensagem($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal2', [
            'title' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            // 'toast' => true,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'center'
        ]);
    }

    private function mensagemRefresh($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal', [
            'title' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            //'toast' => true,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'top-right'
        ]);
    }
}
