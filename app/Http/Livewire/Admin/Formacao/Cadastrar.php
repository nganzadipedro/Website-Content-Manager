<?php

namespace App\Http\Livewire\Admin\Formacao;

use App\Models\Enoaa\Ano;
use App\Models\Fio\Disciplina;
use App\Models\Fio\Formacao;
use App\Models\Fio\Formacaodisciplina;
use App\Models\Fio\Professorformacao;
use App\Models\Fio\Tipoformacao;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cadastrar extends Component
{

    public $tipos_formacao;
    public $nome;
    public $descricao;
    public $data_inicio;
    public $data_fim;
    public $tipo_formacao_id;
    public $custo;
    public $lista = array();
    public $editar = false;
    public $formacao_id = null;

    public function render()
    {
        $this->tipos_formacao = Tipoformacao::all();
        $this->lista = Formacao::all();

        return view('dashboard.admin.formacao.cadastrar')->extends('layouts.app')->section('conteudo');
    }

    public function cadastrar()
    {

        if ($this->editar == false) {
            $ano = Ano::where('estado', 'Activo')->first();
            $formacao = Formacao::create([
                'nome' => $this->nome,
                'descricao' => $this->descricao,
                'ativo' => 'Sim',
                'hash' => md5($this->nome . $this->descricao),
                'user_id' => Auth::id(),
                'data_inicio' => $this->data_inicio,
                'data_fim' => $this->data_fim,
                'ano_id' => $ano->id,
                'valor_custo' => $this->custo,
                'tipoformacao_id' => $this->tipo_formacao_id
            ]);

            // atribuir as disciplinas
            if ($this->tipo_formacao_id == 1) {
                $disciplinas = Disciplina::all();
                foreach ($disciplinas as $item) {
                    $res = Formacaodisciplina::create([
                        'formacao_id' => $formacao->id,
                        'disciplina_id' => $item->id,
                        'user_id' => Auth::id()
                    ]);
                }
            }

            $this->mensagemRefresh('Cadastrado com sucesso', 'success');

        } else {

            $formacao = Formacao::find($this->formacao_id);
            $formacao->data_fim = $this->data_fim;
            $formacao->data_inicio = $this->data_inicio;
            $formacao->descricao = $this->descricao;
            $formacao->nome = $this->nome;
            $formacao->valor_custo = $this->custo;
            $formacao->tipoformacao_id = $this->tipo_formacao_id;
            $formacao->save();

            $this->mensagemRefresh('Formação editada com sucesso', 'success');
        }

    }

    public function selecionar($id)
    {

        $formacao = Formacao::find($id);
        $this->data_fim = $formacao->data_fim;
        $this->data_inicio = $formacao->data_inicio;
        $this->descricao = $formacao->descricao;
        $this->nome = $formacao->nome;
        $this->custo = $formacao->valor_custo;
        $this->tipo_formacao_id = $formacao->tipoformacao_id;
        $this->editar = true;
        $this->formacao_id = $id;

    }

    public function eliminar($id)
    {

        $formacao = Formacao::find($id);
        if (count($formacao->getAlunos) > 0) {
            $this->mensagem('Esta formação não pode ser eliminada', 'warning');
        } else {
            $formacao->delete();
        }

    }

    private function mensagemRefresh($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal', [
            'title' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            'toast' => true,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'top-right'
        ]);
    }

    private function mensagem($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal2', [
            'title' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            'toast' => true,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'top-right'
        ]);
    }
}
