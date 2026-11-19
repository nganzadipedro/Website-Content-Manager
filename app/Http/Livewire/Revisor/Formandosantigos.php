<?php

namespace App\Http\Livewire\Revisor;

use App\Models\Enoaa\Pessoa;
use App\Models\Fio\Aluno;
use Livewire\Component;

class Formandosantigos extends Component
{

    public $formandos = array();

    public function render()
    {
        $this->formandos = Aluno::where('e_antigo', 'sim')->get();
        return view('dashboard.revisor.formandos-antigos')->extends('layouts.app')->section('conteudo');
    }

    public function dados_actualizados($id){

        $aluno = Aluno::find($id);
        $pessoa = Pessoa::find($aluno->pessoa_id);

        if($aluno->num_cedula_advogado == null || $aluno->num_cedula_advogado == ''){
            return false;
        }
        else if($pessoa->nome == null || $pessoa->nome == ''){
            return false;
        }
        else if($pessoa->email == null || $pessoa->email == ''){
            return false;
        }
        else if($pessoa->num_documento == null || $pessoa->num_documento == ''){
            return false;
        }
        else if($pessoa->telefone1 == null || $pessoa->telefone1 == ''){
            return false;
        }
        else if($pessoa->telefone2 == null || $pessoa->telefone2 == ''){
            return false;
        }
        else if($pessoa->genero == null || $pessoa->genero == ''){
            return false;
        }
        else{
            return true;
        }

    }
}
