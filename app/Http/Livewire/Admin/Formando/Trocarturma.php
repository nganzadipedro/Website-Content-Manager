<?php

namespace App\Http\Livewire\Admin\Formando;

use Livewire\Component;
use App\Models\Fio\Turma;
use App\Models\Fio\Aluno;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ActividadesistemaController;
use App\Models\Fio\Alunoformacao;
use App\Models\Fio\Candidaturaformacao;

class Trocarturma extends Component
{

    public $turmas = array();
    public $codigo;
    public $candidatura = null;
    public $nome_candidato = '';
    public $num_documento = '';
    public $estado = '';
    public $formacao = '';
    public $turma_actual = '';
    public $tem = false;
    public $provincias = array();
    public $turma_id;

    public function render()
    {
        $this->turmas = Turma::all();
        return view('dashboard.admin.formando.trocar-turma')->extends('layouts.app')->section('conteudo');
    }

    function verificar()
    {
        if ($this->codigo == null || $this->codigo == '') {
            $this->mensagem('Digite o código do candidato', 'warning');
        } else {

            $this->codigo = trim($this->codigo);
            $this->candidatura = Candidaturaformacao::where('codigo', $this->codigo)
                ->first();

            if ($this->candidatura == null) {
                $this->mensagem('candidatura inexistente', 'warning');
                $this->tem = false;
            } else if ($this->candidatura->estado != 'aprovado' || $this->candidatura->pago != 'pago') {
                $this->mensagem('Candidaturas não pagas, não podem trocar de turma', 'warning');
                $this->tem = false;
            } else {

                $this->tem = true;
                $this->nome_candidato = $this->candidatura->getPessoa->nome;
                $this->num_documento = $this->candidatura->getPessoa->num_documento;
                $this->estado = $this->candidatura->estado;
                $turma = Turma::find($this->candidatura->turma_id);
                $this->formacao = $turma->getFormacao->nome;
                $this->turma_actual = $turma->descricao;
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
            $this->turma_actual = '';
            $this->formacao = '';
            $this->candidatura == null;
        } else {

            if ($this->turma_id == null || $this->turma_id == '') {
                $this->mensagem('Selecione a nova turma para o candidato', 'warning');
            } else if ($this->candidatura->estado == 'pendente' || $this->candidatura->estado == 'suspenso') {
                $this->mensagem('Candidaturas pendentes e suspensas não podem fazer mudança de turma', 'warning');
            } else if ($this->candidatura->estado == 'aprovado' && $this->candidatura->pago == 'não pago') {
                $this->mensagem('Esta candidatura ainda não foi paga. Nao poderá fazer mudança de turma', 'warning');
            } else if ($this->candidatura->turma_id == $this->turma_id) {
                $this->mensagem('Selecione uma nova turma para o candidato', 'warning');
            } else {

                $aluno = Aluno::where('pessoa_id', $this->candidatura->pessoa_id)->first();
                $aluno_form = Alunoformacao::where('aluno_id', $aluno->id)->first();

                if ($this->turma_id == null || $this->turma_id == '') {
                    $this->mensagem('Indique a nova turma para o candidato', 'warning');
                } else {

                    $turma_antiga = Turma::find($this->candidatura->turma_id);
                    $antiga = $turma_antiga->descricao;
                    $turma_nova = Turma::find($this->turma_id);
                    $nova = $turma_nova->descricao;

                    $nome = $this->nome_candidato;
                    $msg = "Trocou a turma do candidato $nome de $antiga para $nova";

                    $this->candidatura->turma_id = $this->turma_id;
                    $this->candidatura->formacao_id = $turma_nova->formacao_id;
                    $this->candidatura->year_id = $turma_nova->getFormacao->ano_id;
                    $this->candidatura->save();

                    $aluno_form->turma_id = $this->turma_id;
                    $aluno_form->formacao_id = $turma_nova->formacao_id;
                    $aluno_form->save();

                    ActividadesistemaController::inserir(Auth::id(), $msg, 'CEF', 'candidatura', $this->candidatura->id);

                    $this->mensagemRefresh('Troca de turma efectuada com sucesso', 'success');
                    $this->tem = false;
                    $this->nome_candidato = '';
                    $this->num_documento = '';
                    $this->estado = '';
                    $this->turma_actual = '';
                    $this->formacao = '';
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
