<?php

namespace App\Http\Livewire\Admin\Formando;

use Livewire\Component;
use App\Models\Fio\Turma;
use App\Models\Fio\Alunoformacao;

class Verturma extends Component
{

    public $turma;
    public $turma_id;
    public $alunos_turma = array();
    public $homens = 0;
    public $mulheres = 0;

    public function mount($id_turma){
        $this->turma_id = $id_turma;
        $this->turma = Turma::find($this->turma_id);
    }

    public function render()
    {
        $this->alunos_turma = Alunoformacao::join('aluno', 'alunos_formacao.aluno_id', 'aluno.id')
        ->join('pessoas', 'pessoas.id', 'aluno.pessoa_id')
        ->where('alunos_formacao.turma_id', $this->turma_id)
        ->whereNull('alunos_formacao.deleted_at')
        ->select('alunos_formacao.*')
        ->orderBy('pessoas.nome', 'asc')
        ->get();

        foreach($this->alunos_turma as $item){
            if($item->getAluno->getPessoa->genero == 'Masculino'){
                $this->homens++;
            }
            else{
                $this->mulheres++;
            }
        }
        
        return view('dashboard.admin.formando.ver-turma')->extends('layouts.app')->section('conteudo');

    }
}
