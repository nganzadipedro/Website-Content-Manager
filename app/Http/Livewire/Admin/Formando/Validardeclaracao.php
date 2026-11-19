<?php

namespace App\Http\Livewire\Admin\Formando;

use App\Http\Controllers\ActividadesistemaController;
use App\Models\Fio\Avaliacaoaluno;
use App\Models\Fio\Emissaodeclaracao;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Validardeclaracao extends Component
{

    public $codigo;
    public $nome;
    public $bilhete;
    public $cedula;
    public $turma;
    public $formacao;
    public $data_emissao;
    public $token;
    public $tem;
    public $ano;
    public $notafinal;
    public $codigo_declaracao;

    public function render()
    {
        return view('dashboard.admin.formando.validar-declaracao')->extends('layouts.app')->section('conteudo');
    }

    function verificar()
    {

        $this->tem = '';
        $this->nome = '';
        $this->bilhete = '';
        $this->cedula = '';
        $this->turma = '';
        $this->formacao = '';
        $this->ano = '';
        $this->token = '';
        $this->notafinal = '';
        $this->codigo_declaracao = '';


        if ($this->codigo == null || $this->codigo == '') {
            $this->mensagem('Digite o token de validação', 'warning');
        } else if (strlen($this->codigo) < 6) {
            $this->mensagem('Token de validação incorrecto', 'warning');
        } else {

            $res = Emissaodeclaracao::where('min_hash', $this->codigo)
                ->first();

            if ($res == null) {
                $this->tem = 'false';
                $this->mensagem('Não foi encontrado nenhum registo de declaração', 'error');
            } else {

                $this->tem = 'true';
                $this->nome = $res->getAluno->getPessoa->nome;
                $this->bilhete = $res->getAluno->getPessoa->num_documento;
                $this->cedula = $res->getAluno->num_cedula_advogado;
                $this->turma = $res->getTurma->descricao;
                $this->formacao = $res->getFormacao->nome;
                $this->ano = $res->getFormacao->getAno->descricao;
                $this->codigo_declaracao = $res->codigo;
                $this->token = $res->min_hash;
                $this->codigo = '';

                // faz o cálculo das notas
                $this->avaliacao_aluno = Avaliacaoaluno::where('aluno_id', $res->aluno_id)
                    ->where('formacao_id', $res->formacao_id)
                    ->where('turma_id', $res->turma_id)
                    ->get();

                $this->notafinal = 0;
                $quant_discip = count($res->getTurma->getFormacao->getDisciplinas);
                foreach ($this->avaliacao_aluno as $av) {
                    $this->notafinal += $av->notafinal;
                }

                if ($quant_discip > 0) {
                    $this->notafinal = $this->notafinal / $quant_discip;
                }

                // faz o registo de actividade
                $operacao = "Validou a declaração do(a) formando(a) $this->nome";
                ActividadesistemaController::inserir(Auth::id(), $operacao, 'Usuário', 'conta', Auth::id());

                $this->mensagem('Registo encontrado com sucesso', 'success');
                $this->codigo = '';

            }
        }
    }

    private function mensagem($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal2', [
            'title' => $msg,
            'timer' => 4000,
            'icon' => $icon,
            // 'toast' => true,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'center'
        ]);
    }

}
