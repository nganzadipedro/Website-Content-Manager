<?php

namespace App\Http\Livewire\Admin\Formando;

use App\Models\Fio\Alunoformacao;
use Auth;
use Livewire\Component;

class Listar extends Component
{

    public $formandos = array();
    public $homens;
    public $mulheres;


    public function render()
    {

        $this->formandos = Alunoformacao::join('aluno', 'alunos_formacao.aluno_id', 'aluno.id')
            ->join('pessoas', 'pessoas.id', 'aluno.pessoa_id')
            ->select('alunos_formacao.*')
            ->orderBy('pessoas.nome', 'asc')
            ->get();


        if (Auth::user()->permission_id == 4) {
            $this->formandos = Alunoformacao::join('aluno', 'alunos_formacao.aluno_id', 'aluno.id')
                ->join('pessoas', 'pessoas.id', 'aluno.pessoa_id')
                ->join('candidatura', 'candidatura.pessoa_id', 'aluno.pessoa_id')
                ->select('alunos_formacao.*')
                ->where('candidatura.prov_formacao_id', Auth::user()->provincia_id)
                ->orderBy('pessoas.nome', 'asc')
                ->get();
        }


        $this->homens = 0;
        $this->mulheres = 0;

        if (count($this->formandos) > 0) {
            foreach ($this->formandos as $item) {
                if ($item->aluno_id !== null) {
                    if ($item->getAluno->getPessoa->genero == 'Masculino') {
                        $this->homens++;
                    } else {
                        $this->mulheres++;
                    }
                }

            }
        }

        return view('dashboard.admin.formando.listar')->extends('layouts.app')->section('conteudo');

    }
}
