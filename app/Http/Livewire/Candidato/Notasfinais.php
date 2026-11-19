<?php

namespace App\Http\Livewire\Candidato;

use App\Models\Enoaa\Pessoa;
use App\Models\Fio\Aluno;
use App\Models\Fio\Alunoformacao;
use App\Models\Fio\Avaliacaoaluno;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Fio\Turma;
use Illuminate\Support\Facades\Storage;
use Auth;
use Livewire\Component;

class Notasfinais extends Component
{

    public $candidatura;
    public $turma;
    public $pessoa;
    public $aluno;
    public $aluno_formacao;
    public $avaliacao_aluno;
    public $nota_final;
    public $notas_finais = array();
    public $quant_discip;
    public $avisos = array();
    public $tem_aviso = false;
    public $doc_ced = false;
    public $doc_bi = false;


    public function render()
    {

        $this->candidatura = Candidaturaformacao::where('pessoa_id', Auth::user()->pessoa_id)->first();
        if ($this->candidatura) {

            $exists = Storage::disk(name: 'public')->exists('' . $this->candidatura->cedula_advogado);
            if ($exists) {
                $this->doc_ced = true;
            }

            $exists = Storage::disk(name: 'public')->exists('' . $this->candidatura->bilhete_identidade);
            if ($exists) {
                $this->doc_bi = true;
            }

            $this->turma = Turma::find($this->candidatura->turma_id);
            $this->pessoa = Pessoa::find($this->candidatura->pessoa_id);
            $aluno = Aluno::where("pessoa_id", $this->pessoa->id)->first();
            if ($aluno) {

                $this->aluno = $aluno;
                $this->aluno_formacao = Alunoformacao::where('aluno_id', $this->aluno->id)
                    ->first();

                $this->avaliacao_aluno = Avaliacaoaluno::where('aluno_id', $this->aluno->id)
                    ->where('turma_id', $this->aluno_formacao->turma_id)
                    ->get();

                $this->nota_final = 0;
                $this->quant_discip = count($this->turma->getFormacao->getDisciplinas);

                foreach ($this->avaliacao_aluno as $av) {

                    if ($av->notafinal != null) {
                        $this->notas_finais[$av->disciplina_id] = number_format($av->notafinal, 2, ',', '.');
                        $this->nota_final += $av->notafinal;
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
            }
        }

        // verificação das inconformidades
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
                $this->tem_aviso = true;
            } else {
                foreach ($this->avaliacao_aluno as $av) {

                    if ($av->notafinal == null) {
                        $this->avisos[14] = 'Não tem a nota de todos os módulos/disciplinas na plataforma';
                        $this->tem_aviso = true;
                    }
                }
            }
        }

        return view('dashboard.candidato.notas-finais')->extends('layouts.app')->section('conteudo');

    }
}
