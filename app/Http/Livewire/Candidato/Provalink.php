<?php

namespace App\Http\Livewire\Candidato;

use App\Models\Enoaa\Pessoa;
use App\Models\Fio\Aluno;
use App\Models\Fio\Alunoformacao;
use App\Models\Fio\Atribuicaoalunoprova;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Fio\Perguntaprova;
use App\Models\Fio\Prova;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Component;

class Provalink extends Component
{

    public $codigo_aluno;
    public $num_bi_aluno;
    public $email_aluno;
    public $prova;
    public $perguntas = array();
    public $hash_prova;
    public $user;
    public $pessoa;
    public $aluno;

    public $pergunta_inicial;
    public $opcao;
    public $pergunta_seguir;
    public $perg_selected;

    public function mount($hash)
    {
        $this->hash_prova = $hash;
        $this->prova = Prova::where('hash', $this->hash_prova)->first();



        // código de teste
        // $this->user = User::find(Auth::id());
        // $this->pessoa = $this->user->getpessoa;
        // $this->aluno = Aluno::where('pessoa_id', $this->pessoa->id)->first();

        // $resposta = Respostaprova::where('aluno_id', $this->aluno->id)
        //     ->where('pergunta_id', $this->perg_selected)
        //     ->first();

        // if ($resposta) {
        //     $this->opcao = $resposta->resposta_aluno;
        // } else {
        //     $this->opcao = null;
        // }
        // fim do código de teste

        // muda o estado n atabela atribuição de prova
        // $ap = Atribuicaoalunoprova::where('aluno_id', $this->aluno->id)
        //     ->where('prova_id', $this->prova->id)
        //     ->first();
        // $ap->estado = 'realizando';
        // $ap->save();
    }


    public function render()
    {
        return view('dashboard.candidato.provalink')->extends('layouts.app_prova')->section('conteudo');
    }

    public function autenticar()
    {

        if ($this->codigo_aluno == null || $this->codigo_aluno == '' || $this->email_aluno == null || $this->email_aluno == '') {
            $this->mensagem('Digite o seu email e o código de formando', 'error');
        } else {

            $candidato = Candidaturaformacao::where('codigo', $this->codigo_aluno)->first();

            if ($candidato) {

                if ($candidato->estado == 'aprovado' && $candidato->pago == 'pago') {

                    $aluno = Aluno::where('pessoa_id', $candidato->pessoa_id)->first();
                    if ($aluno) {
                        //dd($aluno);

                        $this->aluno = $aluno;
                        $pessoa = Pessoa::find($aluno->pessoa_id);
                        if ($pessoa) {
                            $this->pessoa = $pessoa;
                            $pessoa = Pessoa::find($aluno->pessoa_id);
                            dd($pessoa);
                            if ($pessoa->email == $this->email_aluno) {

                                $user = User::where('pessoa_id', $pessoa->id)->first();
                                if ($user) {

                                    $this->user = $user;
                                    $ap = Atribuicaoalunoprova::where('aluno_id', $aluno->id)
                                        ->where('prova_id', $this->prova->id)
                                        ->where('disciplina_id', $this->prova->disciplina_id)
                                        ->first();

                                    if ($ap != null && $ap->estado != 'realizada') {

                                        // verifica se a prova já deve começar
                                        if ($this->verifica_data($this->prova->id) == 'true') {
                                            Auth::login($user);
                                            $this->mensagem('Confirmado com sucesso', 'success');
                                            return redirect()->route('candidato.fazerprova', [$this->prova->hash, $aluno->hash]);
                                        } else {

                                            $this->mensagem('A prova está indisponível neste momento', 'info');

                                        }

                                    } else {
                                        $this->mensagem('Não tem permissão de fazer esta prova', 'error');
                                    }
                                } else {
                                    $this->mensagem('Falha na autenticação', 'error');
                                }
                            } else {
                                $this->mensagem('O email digitado está incorrecto', 'error');
                            }
                        } else {
                            $this->mensagem('Os seus dados não existem na base de dados', 'error');
                        }



                    } else {
                        $this->mensagem('Formando não existente na base de dados', 'error');
                    }

                } else {
                    $this->mensagem('A sua candidatura não está em conformidade. Contacte a Coordenação do CEF.', 'error');
                }


            } else {
                $this->mensagem('O código digitado não foi encontrado', 'error');
            }
        }


    }

    public function verifica_data($id)
    {

        date_default_timezone_set("Africa/Luanda");
        $data_hoje = date("Y-m-d");
        $hora_hoje = date("H:i:s");
        $prova = Prova::find($id);

        if ($prova->ativo == 'Sim') {

            //return 'true';

            if ($data_hoje != $prova->data_prova) {
                return 'erro_data';
            } else {
                if (strtotime($hora_hoje) < strtotime($prova->hora_inicio)) {
                    return 'erro_hora';
                } else if (strtotime($hora_hoje) >= strtotime($prova->hora_fim)) {
                    return 'erro_hora';
                } else if (strtotime($hora_hoje) >= strtotime($prova->hora_inicio)) {

                    // verifica se o aluno já fez a prova
                    $ap = Atribuicaoalunoprova::where('prova_id', $prova->id)
                        ->where('aluno_id', $this->aluno->id)
                        ->first();

                    //dd($ap);

                    if ($ap->estado == 'realizada') {
                        return 'prova realizada';
                    } else {
                        return 'true';
                    }
                }
            }
        } else {
            return 'false';
        }
    }

    private function mensagem($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal2', [
            'title' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            'toast' => false,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'center',
            // 'toast' => true,
            // 'showConfirmButton' => false,
            // 'timerProgressBar' => true,
            // 'position' => 'top-right'
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
