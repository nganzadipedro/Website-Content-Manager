<?php

namespace App\Http\Livewire\Candidato;

use Livewire\Component;
use App\Models\Enoaa\Pessoa;
use App\Models\Fio\Aluno;
use App\Models\Fio\Atribuicaoalunoprova;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Fio\Perguntaprova;
use App\Models\Fio\Prova;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Provalinksemauth extends Component
{

    public $hash_prova;
    public $prova;

    public function mount($hash)
    {
        $this->prova = Prova::where('hash', $this->hash_prova)->first();
    }
    public function render()
    {
        if ($this->verifica_data($this->prova->id) == 'true') {
            return view('dashboard.candidato.prova-sem-auth')->extends('layouts.app_prova')->section('conteudo');
        } else {
            return view('dashboard.candidato.tempo-espera-prova')->extends('layouts.app_prova')->section('conteudo');
        }

    }

    public function verifica_data($id)
    {

        date_default_timezone_set("Africa/Luanda");
        $data_hoje = date("Y-m-d");
        $hora_hoje = date("H:i:s");
        $prova = Prova::find($id);

        if ($prova->ativo == 'Sim') {
            if ($data_hoje != $prova->data_prova) {
                return 'erro_data';
            } else {
                if (strtotime($hora_hoje) < strtotime($prova->hora_inicio)) {
                    return 'erro_hora';
                } else if (strtotime($hora_hoje) >= strtotime($prova->hora_fim)) {
                    return 'erro_hora';
                } else if (strtotime($hora_hoje) >= strtotime($prova->hora_inicio)) {

                    // verifica se o aluno já fez a prova
                    // $ap = Atribuicaoalunoprova::where('prova_id', $prova->id)
                    //     ->where('aluno_id', $this->aluno->id)
                    //     ->first();

                    //dd($ap);
                    // if ($ap->estado == 'realizada') {
                    //     return 'prova realizada';
                    // } else {
                    //     return 'true';
                    // }

                    return 'true';

                }
            }
        } else {
            return 'false';
        }
    }
}
