<?php

namespace App\Http\Livewire\Admin\Formando;

use App\Models\Fio\Aluno;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Fio\Emissaodeclaracao;
use App\Models\Fio\Solicitacaodocumento;
use Auth;
use Livewire\Component;

class Declaracoes extends Component
{

    public $lista = array();

    public function render()
    {

        // $this->lista = Emissaodeclaracao::join('aluno', 'emissao_declaracao.aluno_id', 'aluno.id')
        //     ->join('pessoas', 'pessoas.id', 'aluno.pessoa_id')
        //     ->select('emissao_declaracao.*')
        //     ->get();

        $this->lista = Emissaodeclaracao::all();

        if (Auth::user()->permission_id == 4) {

            $this->lista = Emissaodeclaracao::join('aluno', 'emissao_declaracao.aluno_id', 'aluno.id')
                ->join('pessoas', 'pessoas.id', 'aluno.pessoa_id')
                ->join('candidatura', 'candidatura.pessoa_id', 'aluno.pessoa_id')
                ->select('emissao_declaracao.*')
                ->where('candidatura.prov_formacao_id', Auth::user()->provincia_id)
                ->get();

        }

        $this->homens = 0;
        $this->mulheres = 0;

        if (count($this->lista) > 0) {
            foreach ($this->lista as $item) {
                if ($item->aluno_id !== null) {
                    if ($item->getAluno->getPessoa->genero == 'Masculino') {
                        $this->homens++;
                    } else {
                        $this->mulheres++;
                    }
                }

            }
        }

        return view('dashboard.admin.formando.declaracoes')->extends('layouts.app')->section('conteudo');
    }

    public function getHashes($id_declaracao)
    {

        $res = array();
        $declaracao = Emissaodeclaracao::find($id_declaracao);
        $aluno = $declaracao->getAluno;
        if ($aluno->e_antigo != 'sim') {

            $candidatura = Candidaturaformacao::where('aluno_id', $declaracao->aluno_id)
                ->where('turma_id', $declaracao->turma_id)
                ->first();

            if ($candidatura) {
                $res[0] = $candidatura->hash;
                $res[1] = $declaracao->getAluno->hash;
            } else {
                dd($id_declaracao);
            }

        } else {
            $res[0] = $declaracao->getAluno->hash;
        }

        return $res;

    }
}
