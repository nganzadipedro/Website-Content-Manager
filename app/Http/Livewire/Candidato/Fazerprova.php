<?php

namespace App\Http\Livewire\Candidato;

use App\Models\Fio\Aluno;
use App\Models\Fio\Alunoformacao;
use App\Models\Fio\Atribuicaoalunoprova;
use App\Models\Fio\Avaliacaoaluno;
use App\Models\Fio\Perguntaprova;
use App\Models\Fio\Respostaprova;
use App\Models\Fio\Prova;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use DateTime;

class Fazerprova extends Component
{

    public $prova;
    public $perguntas = array();
    public $hash_prova;
    public $user;
    public $pessoa;
    public $aluno;

    public $pergunta_inicial;
    public $opcao;
    public $disciplina_id;
    public $pergunta_seguir;
    public $perg_selected;
    public $p_hash_aluno;
    public $aluno_formacao;

    public function mount($hash, $hash2)
    {
        $this->hash_prova = $hash;
        $this->p_hash_aluno = $hash2;
        $this->prova = Prova::where('hash', $this->hash_prova)->first();
        $this->pergunta_inicial = Perguntaprova::where('prova_id', $this->prova->id)->orderBy('numero', 'asc')->first();
        $this->perg_selected = $this->pergunta_inicial->id;
        $this->disciplina_id = $this->prova->disciplina_id;

        // código de teste
        $this->user = User::find(Auth::id());
        $this->pessoa = $this->user->getpessoa;
        $this->aluno = Aluno::where('pessoa_id', $this->pessoa->id)->first();
      

        $resposta = Respostaprova::where('aluno_id', $this->aluno->id)
            ->where('pergunta_id', $this->perg_selected)
            ->where('disciplina_id', $this->disciplina_id)
            ->first();

        if ($resposta) {
            $this->opcao = $resposta->resposta_aluno;
        } else {
            $this->opcao = null;
        }
        // fim do código de teste

        // muda o estado n atabela atribuição de prova
        $ap = Atribuicaoalunoprova::where('aluno_id', $this->aluno->id)
            ->where('prova_id', $this->prova->id)
            ->where('disciplina_id', $this->disciplina_id)
            ->first();
            
        $ap->estado = 'realizando';
        $ap->save();

    }

    public function render()
    {
        $this->user = User::find(Auth::id());
        $this->pessoa = $this->user->getpessoa;
        $this->aluno = Aluno::where('pessoa_id', $this->pessoa->id)->first();
        $this->perguntas = Perguntaprova::where('prova_id', $this->prova->id)->orderBy('numero', 'asc')->get();

        // diferença entre horas
        // $hora1 = new DateTime(date("H:i:s"));
        // $hora2 = new DateTime($this->prova->hora_fim);
        // $diferenca = $hora1->diff($hora2);
        // dd($diferenca);

        return view('dashboard.candidato.fazer_prova')->extends('layouts.app_prova')->section('conteudo');
    }

    public function getpergunta($id_perg)
    {
        $this->pergunta_seguir = Perguntaprova::find($id_perg);
        $this->perg_selected = $this->pergunta_seguir->id;

        $resposta = Respostaprova::where('aluno_id', $this->aluno->id)
            ->where('pergunta_id', $this->pergunta_seguir->id)
            ->where('disciplina_id', $this->disciplina_id)
            ->first();

        if ($resposta) {
            $this->opcao = $resposta->resposta_aluno;
        } else {
            $this->opcao = null;
        }

    }

    public function salvar_pergunta()
    {

        $perg_responder = Perguntaprova::find($this->perg_selected);

        if ($this->opcao == null) {
            $this->mensagem('Escolha a sua resposta', 'warning');
        } else {
            
            $cotacao = $perg_responder->resposta_opcao == $this->opcao ? $perg_responder->cotacao : 0;
            
            $verifica = Respostaprova::where('aluno_id', $this->aluno->id)
                ->where('disciplina_id', $this->disciplina_id)
                ->where('pergunta_id', $perg_responder->id)->first();

                
            if ($verifica) {

                $verifica->resposta_aluno = $this->opcao;
                $verifica->cotacao = $cotacao;
                $verifica->save();
                
            } else {
                $resposta = Respostaprova::create([
                    'prova_id' => $this->prova->id,
                    'disciplina_id' => $this->prova->getdisciplina->id,
                    'aluno_id' => $this->aluno->id,
                    'pergunta_id' => $perg_responder->id,
                    'resposta_aluno' => $this->opcao,
                    'cotacao' => $cotacao,
                    'user_id' => Auth::id()
                ]);

            }

            $this->mensagem('Resposta confirmada', 'success');
        }

    }

    // public function contagem()
    // {

    //     // Defina a data alvo (ano, mês, dia, hora, minuto, segundo)
    //     $target = mktime(19, 0, 0, 10, 25, 2024);

    //     // Obtenha a data e hora atuais
    //     $now = time();

    //     // Calcule a diferença em segundos
    //     $difference = $target - $now;

    //     // Converta a diferença em dias, horas, minutos e segundos
    //     $days = floor($difference / 86400);
    //     $hours = floor(($difference % 86400) / 3600);
    //     $minutes = floor(($difference % 3600) / 60);
    //     $seconds = $difference % 60;

    //     // Exiba a contagem regressiva
    //     dd("Faltam $days dias, $hours horas, $minutes minutos e $seconds segundos para o evento.");

    // }

    public function verifica_tempo()
    {

        date_default_timezone_set("Africa/Luanda");
        $hora_hoje = date("H:i:s");

        if($this->prova->ativo == 'Não'){
            $this->processo_fim();
            $this->mensagemfim('Terminou o tempo da prova. Aguarde o seu resultado', 'success');
            return redirect()->route('candidato.provas');
        }
        else if (strtotime($hora_hoje) < strtotime($this->prova->hora_fim)) {
            return 'false';
        }
        else if (strtotime($hora_hoje) >= strtotime($this->prova->hora_fim)) {
            $this->processo_fim();
            $this->mensagemfim('Terminou o tempo da prova. Aguarde o seu resultado', 'success');
            return redirect()->route('candidato.provas');
        }

    }

    public function processo_fim()
    {
        
        $ap = Atribuicaoalunoprova::where('aluno_id', $this->aluno->id)
            ->where('prova_id', $this->prova->id)
            ->where('disciplina_id', $this->disciplina_id)
            ->first();
        $ap->estado = 'realizada';
        $ap->save();

        $respostas = Respostaprova::where('prova_id', $this->prova->id)
            ->where('aluno_id', $this->aluno->id)
            ->where('disciplina_id', $this->disciplina_id)
            ->get();
        $nota = 0;
        foreach ($respostas as $resp) {
            $nota = $nota + $resp->cotacao;
        }

        // verifica se já está na tabela de avaliação
        $this->aluno_formacao = Alunoformacao::where('aluno_id', $this->aluno->id)->first();
        $formacao_id = $this->aluno_formacao->formacao_id;
        $turma_id = $this->aluno_formacao->turma_id;
        $disciplina_id = $this->prova->disciplina_id;

        $existe = Avaliacaoaluno::where('aluno_id', $this->aluno->id)
            ->where('turma_id', $turma_id)
            ->where('disciplina_id', $disciplina_id)
            ->first();

        // dd($existe);

        if ($existe) {
            $existe->nota1 = $nota;
            $existe->save();
        } else {

            // insere na tabela avaliação do aluno
            $ava = Avaliacaoaluno::create([
                'aluno_id' => $this->aluno->id,
                'formacao_id' => $formacao_id,
                'turma_id' => $turma_id,
                'disciplina_id' => $disciplina_id,
                'nota1' => $nota
            ]);
        }

    }

    public function concluir_prova()
    {

        $this->processo_fim();
        $this->mensagemfim('A prova foi finalizada pelo formando. Aguarde o seu resultado', 'success');
        return redirect()->route('candidato.provas');

    }

    private function mensagem($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal2', [
            'title' => $msg,
            'timer' => 3000,
            'icon' => $icon,
            'toast' => true,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'top-right'
        ]);
    }

    private function mensagemfim($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal2', [
            'title' => $msg,
            'timer' => 6000,
            'icon' => $icon,
            'toast' => false,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'center'
        ]);
    }
}
