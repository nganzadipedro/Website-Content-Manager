<?php

namespace App\Http\Livewire\Revisor;

use App\Models\Fio\Aluno;
use App\Models\Fio\Alunoformacao;
use App\Models\Fio\Formacao;
use App\Models\Fio\Gostoturma;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Formacoes extends Component
{

    public $formacoes = array();
    public $esta_inscrito = null;
    public $gostei = null;
    public $pessoa = null;
    public $aluno = null;
    public $aluno_formacao = null;


    public function render()
    {

        $user = User::find(Auth::id());
        if($user->permission_id == 5){

            $this->pessoa = $user->getPessoa;
            $this->aluno = Aluno::where('pessoa_id', $this->pessoa->id)->first();
            if($this->aluno){
                $res= Alunoformacao::where('aluno_id', $this->aluno->id)->first();
                if($res){
                    $this->aluno_formacao = $res;
                }
            }
            
        }
        $this->formacoes = Formacao::all();
        return view('dashboard.revisor.formacoes')->extends('layouts.app')->section('conteudo');
    }

    public function deu_like($formacao_id){
        $res = Gostoturma::where('user_id', Auth::id())
        ->where('formacao_id', $formacao_id)->first();

        if($res){
            return 'true';
        }

        return 'false';
    }

    public function gostei(){
        $res = Gostoturma::create([
            'turma_id' => $this->aluno_formacao->turma_id,
            'formacao_id' => $this->aluno_formacao->formacao_id,
            'user_id' => Auth::id()
        ]);
    }
}
