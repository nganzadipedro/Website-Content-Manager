<?php

namespace App\Http\Livewire\Admin\Formando;

use App\Http\Controllers\ActividadesistemaController;
use App\Http\Controllers\ProxyPayController;
use App\Models\Enoaa\Pessoa;
use App\Models\Fio\Aluno;
use App\Models\Fio\Alunoformacao;
use App\Models\Fio\Avaliacaoaluno;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Fio\Emolumento;
use App\Models\Fio\Formacao;
use App\Models\Fio\Solicitacaodocumento;
use App\Models\Fio\Turma;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Carbon\Carbon;

class Emitirdeclaracao extends Component
{

    public $turmas = array();
    public $formacoes = array();
    public $codigo;

    public $doc_ced = false;
    public $doc_bi = false;
    public $candidatura = null;
    public $nome_candidato = '';
    public $num_documento = '';
    public $turma_id;
    public $formacao_id;
    public $tem;
    public $turma;
    public $formacao;
    public $cedula;
    public $tem_aviso = false;

    public $avisos = array();
    public $avaliacao_aluno;
    public $nota_final;
    public $solicitacao;
    public $aluno;
    public $dia_actual;
    public $pessoa;

    public function render()
    {

        $this->dia_actual = Carbon::today();
        $this->formacoes = Formacao::all();
        return view('dashboard.admin.formando.emitir-declaracao', ['dia_actual' => $this->dia_actual])->extends('layouts.app')->section('conteudo');

    }

    function verificar()
    {

        if ($this->formacao_id == null || $this->formacao_id == '') {
            $this->mensagem('Escolha a formação', 'warning');
        } else if ($this->turma_id == null || $this->turma_id == '') {
            $this->mensagem('Escolha a turma', 'warning');
        } else if ($this->codigo == null || $this->codigo == '') {
            $this->mensagem('Digite o código do candidato', 'warning');
        } else {

            $this->candidatura = Candidaturaformacao::where('codigo', trim($this->codigo, ' '))
                ->first();

            if ($this->candidatura == null) {
                $this->mensagem('candidatura inexistente', 'warning');
                $this->tem = false;
            } else {

                $this->pessoa = $this->candidatura->getPessoa;
                $al = Aluno::where('pessoa_id', $this->candidatura->pessoa_id)->first();
                $this->aluno = $al;

                if ($this->aluno != null) {

                    $af = Alunoformacao::where('turma_id', $this->turma_id)
                        ->where('formacao_id', $this->formacao_id)
                        ->where('aluno_id', $al->id)->first();

                    $turma = Turma::find($af->turma_id);

                    if ($turma->emitir_declaracao == 'nao' || $this->pessoa->id == 6173 || $this->pessoa->id == 5553) {
                        $this->mensagem('Esta turma ainda não tem permissão de emitir declaração', 'warning');
                        $this->tem = false;
                    } else {

                        $this->tem = true;
                        $this->nome_candidato = $this->candidatura->getPessoa->nome;
                        $this->num_documento = $this->candidatura->getPessoa->num_documento;
                        $this->cedula = $al->num_cedula_advogado;
                        $this->formacao = $af->getFormacao->nome;
                        $this->turma = $af->getTurma->descricao;

                        // verificação de avisos
                        $exists = Storage::disk(name: 'public')->exists('' . $this->candidatura->cedula_advogado);
                        if ($exists) {
                            $this->doc_ced = true;
                        }

                        $exists = Storage::disk(name: 'public')->exists('' . $this->candidatura->bilhete_identidade);
                        if ($exists) {
                            $this->doc_bi = true;
                        }

                        $this->avisos = null;
                        if ($this->pessoa->num_documento == null || $this->pessoa->num_documento == '') {
                            $this->avisos[0] = 'O candidato deve actualizar o seu número do bilhete no sistema';
                            $this->tem_aviso = true;
                        }
                        if ($this->doc_bi == false) {
                            $this->avisos[1] = 'O candidato deve carregar no sistema o seu bilhete de identidade em formato PDF';
                            $this->tem_aviso = true;
                        }
                        if ($this->doc_ced == false) {
                            $this->avisos[2] = 'O candidato deve carregar no sistema a cédula de advogado estagiário em formato PDF';
                            $this->tem_aviso = true;
                        }
                        if ($this->pessoa->nome == null || $this->pessoa->nome == '') {
                            $this->avisos[3] = 'Actualize o seu nome completo';
                            $this->tem_aviso = true;
                        }
                        if ($this->pessoa->email == null || $this->pessoa->email == '') {
                            $this->avisos[4] = 'Actualize o seu email';
                            $this->tem_aviso = true;
                        }
                        if ($this->pessoa->telefone1 == null || $this->pessoa->telefone1 == '') {
                            $this->avisos[5] = 'Actualize o número de telefone principal';
                            $this->tem_aviso = true;
                        }
                        if ($this->pessoa->telefone2 == null || $this->pessoa->telefone2 == '') {
                            $this->avisos[6] = 'Actualize o número de telefone alternativo';
                            $this->tem_aviso = true;
                        }
                        if ($this->pessoa->genero == null || $this->pessoa->genero == '') {
                            $this->avisos[7] = 'Actualize o seu género';
                            $this->tem_aviso = true;
                        }
                        if ($this->aluno->num_cedula_advogado == null || $this->aluno->num_cedula_advogado == '') {
                            $this->avisos[8] = 'Actualize o seu número de cédula de advogado estagiário';
                            $this->tem_aviso = true;
                        }
                        if ($this->aluno->nome_patrono == null || $this->aluno->nome_patrono == '') {
                            $this->avisos[9] = 'Actualize o nome do seu patrono';
                            $this->tem_aviso = true;
                        }
                        if ($this->aluno->email_patrono == null || $this->aluno->email_patrono == '') {
                            $this->avisos[10] = 'Actualize o email do seu patrono';
                            $this->tem_aviso = true;
                        }
                        if ($this->aluno->telefone_patrono == null || $this->aluno->telefone_patrono == '') {
                            $this->avisos[11] = 'Actualize o número de telefone do patrono';
                            $this->tem_aviso = true;
                        }
                        if ($this->aluno->nome_escritorio == null || $this->aluno->nome_escritorio == '') {
                            $this->avisos[12] = 'Actualize o nome do escritório onde frequenta o estágio';
                            $this->tem_aviso = true;
                        }
                        if ($this->aluno->endereco_escritorio == null || $this->aluno->endereco_escritorio == '') {
                            $this->avisos[13] = 'Actualize o endereço do escritório onde frequenta o estágio';
                            $this->tem_aviso = true;
                        }

                        // faz o cálculo das notas
                        $this->avaliacao_aluno = Avaliacaoaluno::where('aluno_id', $al->id)
                            ->where('formacao_id', $af->formacao_id)
                            ->where('turma_id', $af->turma_id)
                            ->get();

                        $this->nota_final = 0;
                        $quant_discip = count($af->getTurma->getFormacao->getDisciplinas);
                        foreach ($this->avaliacao_aluno as $av) {
                            $this->nota_final += $av->notafinal;
                        }

                        if ($quant_discip > 0) {
                            $this->nota_final = $this->nota_final / $quant_discip;
                        }

                        $this->solicitacao = Solicitacaodocumento::where('aluno_id', $al->id)
                            ->where('turma_id', $af->turma_id)
                            ->first();
                    }

                } else {
                    $this->mensagem('Não foi encontrado nenhum registo', 'warning');
                    $this->tem = false;
                }

            }

        }
    }

    public function pega_turmas()
    {

        $this->turmas = Turma::where('formacao_id', $this->formacao_id)->get();
        $this->turma_id = null;
    }

    public function solicitar_ref_declaracao()
    {

        if ($this->pessoa->num_documento == null || $this->pessoa->num_documento == '') {
            $this->mensagem('Actualize primeiro o seu número do bilhete no sistema', 'warning');
        } else if ($this->doc_ced == false) {
            $this->mensagem('Carregue no sistema a cédula de advogado estagiário em formato PDF', 'warning');
        } else if ($this->doc_bi == false) {
            $this->mensagem('Carregue no sistema o seu bilhete de identidade em formato PDF', 'warning');
        } else {

            $declaracao = Emolumento::find(2);
            $valor = $declaracao->valor;
            $ob = new ProxyPayController();
            $referencia = $ob->gerarReferencia($this->candidatura->getPessoa->telefone1, $this->candidatura->getPessoa->email, $this->candidatura->getPessoa->nome, $valor, 3);

            $today = Carbon::today();
            $data_expiracao = $today->addDays(3);

            $res = Solicitacaodocumento::create([
                'turma_id' => $this->candidatura->turma_id,
                'emolumento_id' => 2,
                'aluno_id' => $this->aluno->id,
                'ano_id' => $this->candidatura->year_id,
                'user_id' => Auth::id(),
                'referencia' => $referencia,
                'validade_referencia' => $data_expiracao
            ]);

            // gerar historico
            ActividadesistemaController::inserir(Auth::id(), 'Solicitou uma referência de pagamento para emissão de declaração', 'Candidato', 'candidatura', $this->candidatura->id);

            $this->mensagemRefresh('Solicitação de referência efectuada com sucesso', 'success');
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
