<?php

namespace App\Http\Livewire\Geral\Provas;

use App\Models\Fio\Perguntaprova;
use App\Models\Fio\Prova;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Gerenciar extends Component
{

    public $hash_prova;
    public $prova;
    public $perguntas = array();
    public $num_pergunta;
    public $pergunta;
    public $opcao_a;
    public $opcao_b;
    public $opcao_c;
    public $opcao_d;
    public $opcao_e;
    public $resposta;
    public $pontuacao;

    public $editar = false;
    public $id_pergunta;

    public function mount($hash)
    {
        $this->hash_prova = $hash;
        $this->prova = Prova::where('hash', $this->hash_prova)->first();

    }
    public function render()
    {
        $this->perguntas = Perguntaprova::where('prova_id', $this->prova->id)->get();
        return view('dashboard.provas.perguntas')->extends('layouts.app')->section('conteudo');
    }

    public function salvar()
    {


        if ($this->editar == false) {
            $verifica = Perguntaprova::where('prova_id', $this->prova->id)
                ->where('numero', $this->num_pergunta)->first();

            if ($verifica) {
                $this->mensagem('Este número da pergunta já existe', 'warning');
            } else if ($this->resposta == 'opcao4' && $this->opcao_d == null) {
                $this->mensagem('A reposta não pode ser uma opção nula', 'warning');
            } else if ($this->resposta == 'opcao5' && $this->opcao_e == null) {
                $this->mensagem('A reposta não pode ser uma opção nula', 'warning');
            } else {
                $pergunta = Perguntaprova::create([

                    "prova_id" => $this->prova->id,
                    "opcao1" => $this->opcao_a,
                    "opcao2" => $this->opcao_b,
                    "opcao3" => $this->opcao_c,
                    "opcao4" => $this->opcao_d,
                    "opcao5" => $this->opcao_e,
                    "corpo_pergunta" => $this->pergunta,
                    "cotacao" => $this->pontuacao,
                    "numero" => $this->num_pergunta,
                    "resposta_opcao" => $this->resposta,
                    "user_id" => Auth::id()
                ]);

                // salva no banco de dados
                $pergunta->hash = md5($pergunta->id . $pergunta->created_at);
                $pergunta->save();
                // ActividadesistemaController::inserir(Auth::id(), "Cadastrou uma nova pergunta para o exame", 'CEF', null, $pergunta->id);
                $this->mensagem('Pergunta cadastrada com sucesso', 'success');


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
        } else {

            $verifica = Perguntaprova::where('prova_id', $this->prova->id)
                ->where('id', '!=', $this->id_pergunta)
                ->where('numero', $this->num_pergunta)->first();

            if ($verifica) {
                $this->mensagem('Este número da pergunta já existe', 'warning');
            } else if ($this->resposta == 'opcao_d' && $this->opcao_d == null) {
                $this->mensagem('A reposta não pode ser uma opção nula', 'warning');
            } else if ($this->resposta == 'opcao_e' && $this->opcao_e == null) {
                $this->mensagem('A reposta não pode ser uma opção nula', 'warning');
            } else {

                $pergunta = Perguntaprova::find($this->id_pergunta);
                $pergunta->opcao1 = $this->opcao_a;
                $pergunta->opcao2 = $this->opcao_b;
                $pergunta->opcao3 = $this->opcao_c;
                $pergunta->opcao4 = $this->opcao_d;
                $pergunta->opcao5 = $this->opcao_e;
                $pergunta->corpo_pergunta = $this->pergunta;
                $pergunta->cotacao = $this->pontuacao;
                $pergunta->numero = $this->num_pergunta;
                $pergunta->resposta_opcao = $this->resposta;
                $pergunta->user_id = Auth::id();
                $pergunta->save();

                // ActividadesistemaController::inserir(Auth::id(), "Actualizou uma pergunta para o exame", 'CEF', null, $pergunta->id);
                $this->mensagem('Pergunta actualizada com sucesso', 'success');


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
        }

    }

    public function limpar()
    {

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

    public function select($id)
    {
        $pergunta = Perguntaprova::find($id);
        $this->id_pergunta = $pergunta->id;
        $this->num_pergunta = $pergunta->numero;
        $this->pergunta = $pergunta->corpo_pergunta;
        $this->opcao_a = $pergunta->opcao1;
        $this->opcao_b = $pergunta->opcao2;
        $this->opcao_c = $pergunta->opcao3;
        $this->opcao_d = $pergunta->opcao4;
        $this->opcao_e = $pergunta->opcao5;
        $this->pontuacao = $pergunta->cotacao;
        $this->resposta = $pergunta->resposta_opcao;
        $this->editar = true;
    }

    public function eliminar($id){
        $pergunta = Perguntaprova::find($id);
        $pergunta->delete();
        $this->mensagem('Pergunta eliminada com sucesso', 'success');
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
