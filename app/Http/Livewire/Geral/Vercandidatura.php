<?php

namespace App\Http\Livewire\Geral;

use App\Http\Controllers\ActividadesistemaController;
use App\Http\Controllers\MIMOController;
use App\Http\Controllers\OmbalaController;
use App\Http\Controllers\ProxyPayController;
use App\Lib\Repositories\MIMORepository;
use App\Models\Enoaa\Pessoa;
use App\Models\Fio\Actividadesistema;
use App\Models\Enoaa\Ano;
use App\Models\Fio\Aluno;
use App\Models\Fio\Avaliacaoaluno;
use App\Models\Fio\Emolumento;
use App\Models\Fio\Solicitacaodocumento;
use App\Models\Fio\Turma;
use App\Models\Fio\Alunoformacao;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Enoaa\Motivo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Livewire\Component;
use \PDF;

class Vercandidatura extends Component
{

    public $aluno = null;
    public $turma = null;
    public $aluno_formacao = null;
    public $candidatura = null;

    public $avaliacao_aluno = null;
    public $motivos = array();
    public $historico;
    public $ano;
    public $pessoa;
    public $formacao;
    public $motivo_suspensao;
    public $motivo_suspensao2;
    public $doc_ced = false;
    public $doc_bi = false;
    public $nota_final;
    public $quant_discip;
    public $solicitacao;
    public $dia_actual;
    public $avisos = array();
    public $notas_finais = array();
    public $tem_aviso = false;

    public function mount($hash)
    {

        if ($hash == 0) {
            $this->candidatura = Candidaturaformacao::where('pessoa_id', Auth::user()->pessoa_id)->first();
        } else {
            $this->candidatura = Candidaturaformacao::where('hash', $hash)->first();
        }

        // dd($this->candidatura);

        // --- IGNORE ---

        if ($this->candidatura) {
            $this->historico = Actividadesistema::where('destino', 'candidatura')
                ->where('destino_id', $this->candidatura->id)
                ->get();

            $this->turma = Turma::find($this->candidatura->turma_id);
            $this->dia_actual = Carbon::today();

            $exists = Storage::disk(name: 'public')->exists('' . $this->candidatura->cedula_advogado);
            if ($exists) {
                $this->doc_ced = true;
            }

            $exists = Storage::disk(name: 'public')->exists('' . $this->candidatura->bilhete_identidade);
            if ($exists) {
                $this->doc_bi = true;
            }

            $this->pessoa = Pessoa::find($this->candidatura->pessoa_id);
            $aluno = Aluno::where("pessoa_id", $this->pessoa->id)->first();
            if ($aluno) {
                $this->aluno = $aluno;

                $this->aluno_formacao = Alunoformacao::where('aluno_id', $this->aluno->id)
                    ->where('formacao_id', $this->candidatura->formacao_id)
                    ->first();

                $this->avaliacao_aluno = Avaliacaoaluno::where('aluno_id', $this->aluno->id)
                    ->where('formacao_id', $this->candidatura->formacao_id)
                    ->get();

                $this->nota_final = 0;
                $this->quant_discip = count($this->turma->getFormacao->getDisciplinas);

                foreach ($this->avaliacao_aluno as $av) {

                    $this->nota_final += $av->notafinal;

                    if ($av->notafinal != null) {
                        $this->notas_finais[$av->disciplina_id] = number_format($av->notafinal, 2, ',', '.');
                    } else {
                        $this->notas_finais[$av->disciplina_id] = 'Sem Nota';
                    }
                }

                if ($this->quant_discip > 0) {

                    $this->nota_final = $this->nota_final / $this->quant_discip;
                    if ($this->nota_final < 10 && $this->nota_final >= 9.5) {
                        $this->nota_final = 10;
                    }

                }

                $this->solicitacao = Solicitacaodocumento::where('aluno_id', $this->aluno->id)
                    ->where('turma_id', $this->turma->id)
                    ->first();
            }
        }
    }

    public function render()
    {

        $this->avisos = null;
        $this->tem_aviso = false;
        if ($this->pessoa->num_documento == null || $this->pessoa->num_documento == '') {
            $this->avisos[0] = 'Actualize o seu número do bilhete no sistema';
            $this->tem_aviso = true;
        }
        if ($this->doc_bi == false) {
            $this->avisos[1] = 'Carregue no sistema o seu bilhete de identidade em formato PDF';
            $this->tem_aviso = true;
        }
        if ($this->doc_ced == false) {
            $this->avisos[2] = 'Carregue no sistema a cédula de advogado estagiário em formato PDF';
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
        if ($this->aluno != null) {
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
        }

        if ($this->avaliacao_aluno != null) {
            if (count($this->avaliacao_aluno) < 5) {
                $this->avisos[14] = 'Não tem a nota de todos os módulos/disciplinas na plataforma';
            }
        }

        $this->motivos = Motivo::all();
        $this->ano = Ano::where('estado', 'Activo')->first();

        if (Auth::user()->permission_id == 5) {
            return view('dashboard.candidato.ver-candidatura')->extends('layouts.app')->section('conteudo');
        }
        return view('dashboard.candidaturas.ver-candidatura')->extends('layouts.app')->section('conteudo');

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
                'turma_id' => $this->turma->id,
                'emolumento_id' => 2,
                'aluno_id' => $this->aluno->id,
                'ano_id' => $this->candidatura->year_id,
                'user_id' => Auth::id(),
                'referencia' => $referencia,
                'validade_referencia' => $data_expiracao
            ]);

            // gerar historico
            ActividadesistemaController::inserir(Auth::id(), 'Solicitou uma referência de pagamento para emissão de declaração', 'Candidato', 'candidatura', $this->candidatura->id);

            $this->mensagem('Solicitação de referência efectuada com sucesso', 'success');
        }

    }

    function aprovar()
    {

        $verifica = Candidaturaformacao::where('pessoa_id', $this->candidatura->pessoa_id)
            ->where('year_id', $this->ano->id)
            ->where('formacao_id', $this->candidatura->formacao_id)
            ->where('estado', 'aprovado')->first();

        if ($verifica) {
            $this->mensagem('Esta candidatura já foi aprovada', 'warning');
            $this->closeModal();
        } else {

            $valor = $this->candidatura->getFormacao->valor_custo;
            $referencia = '';
            $ob = new ProxyPayController();
            $referencia = $ob->gerarReferencia($this->candidatura->getPessoa->telefone1, $this->candidatura->getPessoa->email, $this->candidatura->getPessoa->nome, $valor, 3);

            $this->candidatura->estado = 'aprovado';
            $this->candidatura->pintar = 'Não';
            $this->candidatura->referencia = $referencia;
            $this->candidatura->pago = 'não pago';
            $this->candidatura->save();

            // gerar historico
            ActividadesistemaController::inserir(Auth::id(), 'Aprovou a candidatura', 'CEF', 'candidatura', $this->candidatura->id);

            // regista actividade do sistema
            ActividadesistemaController::inserir(null, 'Enviou a referência de pagamento por SMS', 'Sistema', 'candidatura', $this->candidatura->id);

            // gerar ficha de candidatura
            // $pdf = Pdf::loadView('documents-pdf.ficha-candidato', [
            //     'candidato' => $this->candidato,
            //     'candidatura' => $this->candidatura,
            //     'ano_exame' => $this->ano->descricao
            // ]);

            // guarda o pdf
            // $path = Storage::put('candidatos/' . $this->ano->descricao . '/' . $this->candidatura->codigo . '/' . 'ficha_candidato_' . $this->candidato->id . '.pdf', $pdf->output());
            // Storage::put($path, $pdf->output());

            $this->mensagemRefresh('Candidatura aprovada com sucesso', 'success');
        }
    }

    function suspender()
    {

        $verifica = Candidaturaformacao::where('pessoa_id', $this->candidatura->pessoa_id)
            ->where('year_id', $this->ano->id)
            ->where('formacao_id', $this->candidatura->formacao_id)
            ->where('estado', 'suspenso')->first();

        if ($verifica) {
            $this->mensagem('Esta candidatura já foi suspensa', 'warning');
            $this->closeModal();
        } else {

            if ($this->motivo_suspensao == "" || $this->motivo_suspensao == null) {
                $this->mensagem('Informe o motivo da suspensão', 'warning');
                $this->closeModal();
            } else if ($this->motivo_suspensao == "Outro" && ($this->motivo_suspensao2 == null || $this->motivo_suspensao2 == '')) {
                $this->mensagem('Digite o outro motivo da suspensão', 'warning');
                $this->closeModal();
            } else {

                $motivo = '';
                if ($this->motivo_suspensao == 'Outro') {
                    $motivo = $this->motivo_suspensao2;
                } else {
                    $motivo = $this->motivo_suspensao;
                }

                $this->candidatura->estado = 'suspenso';
                $this->candidatura->pintar = 'Não';
                $this->candidatura->motivo_suspensao = $motivo;
                $this->candidatura->save();


                // gerar historico
                ActividadesistemaController::inserir(Auth::id(), "Suspendeu a candidatura pelo seguinte motivo: $motivo", 'CEF', 'candidatura', $this->candidatura->id);

                // envia mensagem ao candidato que a candidatura foi suspensa
                $mensagem = $this->candidatura->getPessoa->nome . ", a sua candidatura para a formação inicial obrigatória foi suspensa, pelo seguinte motivo: " . $motivo . ". Para mais informações: https://fio.cef-oaa.org";
                $ob = new OmbalaController();
                $ob->enviarMensagem($this->candidatura->getPessoa->telefone1, $mensagem);

                // regista actividade do sistema
                ActividadesistemaController::inserir(null, 'Enviou uma SMS com a notificação da suspensão da candidatura', 'Sistema', 'candidatura', $this->candidatura->id);

                $this->mensagemRefresh('Candidatura suspensa com sucesso', 'success');
            }
        }
    }

    function destacar()
    {

        $candidatura = Candidaturaformacao::find($this->candidatura->id);
        $candidatura->pintar = 'Sim';
        $candidatura->save();

        // gerar historico
        ActividadesistemaController::inserir(Auth::id(), "Destacou a candidatura", 'CEF', 'candidatura', $this->candidatura->id);
        $this->mensagemRefresh('Candidatura destacada com sucesso', 'success');
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

    private function closeModal()
    {
        $this->dispatchBrowserEvent('closeModal', []);
    }
}
