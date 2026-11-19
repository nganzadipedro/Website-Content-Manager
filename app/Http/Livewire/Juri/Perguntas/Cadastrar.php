<?php

namespace App\Http\Livewire\Juri\Perguntas;

use App\Http\Controllers\ActividadesistemaController;
use App\Models\Ano;
use App\Models\Disciplina;
use App\Models\Pergunta;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cadastrar extends Component
{

    public $disciplinas;
    public $disciplina_id;
    public $num_pergunta;
    public $pergunta;
    public $opcao_a;
    public $opcao_b;
    public $opcao_c;
    public $opcao_d;
    public $opcao_e;
    public $resposta;
    public $pontuacao;
    public $perguntas = array();
    public $editar = false;
    public $id_pergunta;

    public function render()
    {
        $ano = Ano::where('estado', 'Activo')->first();
        $this->perguntas = Pergunta::where('year_id', $ano->id)->get();
        $this->disciplinas = Disciplina::all();
        return view('dashboard.juri.perguntas.cadastrar')->extends('layouts.app')->section('conteudo');
    }

    public function salvar()
    {


        $ano = Ano::where('estado', 'Activo')->first();

        if ($this->editar == false) {
            $verifica = Pergunta::where('year_id', $ano->id)
                ->where('disciplina_id', $this->disciplina_id)
                ->where('numero', $this->num_pergunta)->first();

            if ($verifica) {
                $this->mensagem('Este número da pergunta já existe', 'warning');
            } else if ($this->resposta == 'opcao_d' && $this->opcao_d == null) {
                $this->mensagem('A reposta não pode ser uma opção nula', 'warning');
            } else if ($this->resposta == 'opcao_e' && $this->opcao_e == null) {
                $this->mensagem('A reposta não pode ser uma opção nula', 'warning');
            } else {
                $pergunta = Pergunta::create([
                    "year_id"   => $ano->id,
                    "disciplina_id" =>  $this->disciplina_id,
                    "opcao_a"   => $this->opcao_a,
                    "opcao_b"   => $this->opcao_b,
                    "opcao_c"   => $this->opcao_c,
                    "opcao_d"   => $this->opcao_d,
                    "opcao_e"   => $this->opcao_e,
                    "desc_pergunta"   => $this->pergunta,
                    "pontuacao"   => $this->pontuacao,
                    "numero"   => $this->num_pergunta,
                    "resposta"   => $this->resposta,
                    "user_id"   => Auth::id(),
                    "hash_resposta"   => md5($this->resposta)
                ]);

                $disciplina = Disciplina::find($this->disciplina_id);
                // cria o código identificador da pergunta
                $codigo_pergunta = 'Q-' . $disciplina->codigo . $pergunta->numero . '-' .  $ano->descricao;

                // salva no banco de dados
                $pergunta->codigo = $codigo_pergunta;
                $pergunta->hash = md5($codigo_pergunta);
                $pergunta->save();
                ActividadesistemaController::inserir(Auth::id(), "Cadastrou uma nova pergunta para o exame", 'CEF', null, $pergunta->id);
                $this->mensagem('Pergunta cadastrada com sucesso', 'success');
            }
        } else {

            $verifica = Pergunta::where('year_id', $ano->id)
                ->where('disciplina_id', $this->disciplina_id)
                ->where('id', '!=', $this->id_pergunta)
                ->where('numero', $this->num_pergunta)->first();

            if ($verifica) {
                $this->mensagem('Este número da pergunta já existe', 'warning');
            } else if ($this->resposta == 'opcao_d' && $this->opcao_d == null) {
                $this->mensagem('A reposta não pode ser uma opção nula', 'warning');
            } else if ($this->resposta == 'opcao_e' && $this->opcao_e == null) {
                $this->mensagem('A reposta não pode ser uma opção nula', 'warning');
            } else {

                $pergunta = Pergunta::find($this->id_pergunta);
                $pergunta->year_id = $ano->id;
                $pergunta->disciplina_id =  $this->disciplina_id;
                $pergunta->opcao_a = $this->opcao_a;
                $pergunta->opcao_b = $this->opcao_b;
                $pergunta->opcao_c = $this->opcao_c;
                $pergunta->opcao_d = $this->opcao_d;
                $pergunta->opcao_e = $this->opcao_e;
                $pergunta->desc_pergunta = $this->pergunta;
                $pergunta->pontuacao = $this->pontuacao;
                $pergunta->numero = $this->num_pergunta;
                $pergunta->resposta = $this->resposta;
                $pergunta->user_id = Auth::id();
                $pergunta->hash_resposta = md5($this->resposta);

                $disciplina = Disciplina::find($this->disciplina_id);
                // cria o código identificador da pergunta
                $codigo_pergunta = 'Q-' . $disciplina->codigo . $pergunta->numero . '-' .  $ano->descricao;

                // salva no banco de dados
                $pergunta->codigo = $codigo_pergunta;
                $pergunta->hash = md5($codigo_pergunta);
                $pergunta->save();
                ActividadesistemaController::inserir(Auth::id(), "Actualizou uma pergunta para o exame", 'CEF', null, $pergunta->id);
                $this->mensagem('Pergunta actualizada com sucesso', 'success');
            }
        }

        $this->disciplina_id = null;
        $this->num_pergunta = null;
        $this->pergunta = null;
        $this->opcao_a = null;
        $this->opcao_b = null;
        $this->opcao_c = null;
        $this->opcao_d = null;
        $this->opcao_e = null;
        $this->resposta = null;
        $this->pontuacao = null;
    }

    public function limpar(){
        $this->disciplina_id = null;
        $this->num_pergunta = null;
        $this->pergunta = null;
        $this->opcao_a = null;
        $this->opcao_b = null;
        $this->opcao_c = null;
        $this->opcao_d = null;
        $this->opcao_e = null;
        $this->resposta = null;
        $this->pontuacao = null;

        $this->editar = false;
    }

    public function editar($id)
    {
        $pergunta = Pergunta::find($id);
        $this->num_pergunta = $pergunta->numero;
        $this->disciplina_id = $pergunta->disciplina_id;
        $this->pergunta = $pergunta->desc_pergunta;
        $this->opcao_a = $pergunta->opcao_a;
        $this->opcao_b = $pergunta->opcao_b;
        $this->opcao_c = $pergunta->opcao_c;
        $this->opcao_d = $pergunta->opcao_d;
        $this->opcao_e = $pergunta->opcao_e;
        $this->resposta = $pergunta->resposta;
        $this->pontuacao = $pergunta->pontuacao;
        $this->editar = true;
        $this->id_pergunta = $id;
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
