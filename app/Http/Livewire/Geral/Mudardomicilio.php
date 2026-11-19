<?php

namespace App\Http\Livewire\Geral;

use App\Http\Controllers\ActividadesistemaController;
use App\Models\Candidatura;
use App\Models\Provincia;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Mudardomicilio extends Component
{

    public $codigo;
    public $candidatura = null;
    public $nome_candidato = '';
    public $num_documento = '';
    public $estado = '';
    public $domicilio_actual = '';
    public $tem = false;
    public $provincias = array();
    public $provincia_id;

    public function render()
    {
        $this->provincias = Provincia::all();
        return view('dashboard.candidaturas.mudanca-domicilio')->extends('layouts.app')->section('conteudo');
    }

    
    function verificar()
    {
        if ($this->codigo == null || $this->codigo == '') {
            $this->mensagem('Digite o código do candidatura', 'warning');
        } else {
            $this->candidatura = Candidatura::where('codigo', $this->codigo)
                ->first();

            if ($this->candidatura == null) {
                $this->mensagem('candidatura inexistente', 'warning');
                $this->tem = false;
            } else {
                
                $this->tem = true;
                $this->nome_candidato = $this->candidatura->getcandidato->getPessoa->nome;
                $this->num_documento = $this->candidatura->getcandidato->getPessoa->num_documento;
                $this->estado = $this->candidatura->estado;
                $this->domicilio_actual = $this->candidatura->getcandidato->getprovinciaexame->descricao;
            }
        }
    }

    function confirmar()
    {
        if ($this->candidatura == null || $this->candidatura == '') {
            $this->mensagem('Não foi selecionado nenhum candidato', 'warning');
            $this->tem = false;
            $this->nome_candidato = '';
            $this->num_documento = '';
            $this->estado = '';
            $this->domicilio_actual = '';
            $this->candidatura == null;
        } else {

            if ($this->candidatura->estado == 'pendente' || $this->candidatura->estado == 'suspenso') {
                $this->mensagem('Candidaturas pendentes e suspensas não podem fazer mudança de domicílio', 'warning');
            } else if ($this->candidatura->estado == 'aprovado' && $this->candidatura->pago == 'não pago') {
                $this->mensagem('Esta candidatura ainda não foi paga. Nao poderá fazer mudança de domicílio', 'warning');
            } else {

                if($this->provincia_id == null || $this->provincia_id == ''){
                    $this->mensagem('Indique o novo domicílio para o candidato', 'warning');
                }
                else{
                    $candidato = $this->candidatura->getCandidato;
                    $antiga = $candidato->getprovinciaexame->descricao;
                    $prov = Provincia::find($this->provincia_id);
                    $nome = $candidato->getpessoa->nome;
                    $msg = "Trocou o domicilio do candidato $nome de $antiga para $prov->descricao";
                    
                    $candidato->provincia_exame = $this->provincia_id;
                    $candidato->save();
                    
                    ActividadesistemaController::inserir(Auth::id(), $msg, 'CEF', 'candidatura', $this->candidatura->id);
    
                    $this->mensagemRefresh('Troca de domicílio efectuado com sucesso', 'success');
                    $this->tem = false;
                    $this->nome_candidato = '';
                    $this->num_documento = '';
                    $this->estado = '';
                    $this->domicilio_actual = '';
                    $this->provincia_id = null;
                    $this->candidatura == null;
                }
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
            'position' => 'center'
        ]);
    }
}
