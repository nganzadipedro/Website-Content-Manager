<?php

namespace App\Http\Livewire\Revisor;

use App\Models\Enoaa\Pessoa;
use App\Models\Fio\Aluno;
use Livewire\Component;

class Antigosactualizar extends Component
{

    public $hash_aluno;
    public $aluno;
    public $pessoa;
    public $nome;
    public $email;
    public $num_documento;
    public $telefone1;
    public $telefone2;
    public $genero;
    public $num_cedula;

    public function mount($hash)
    {
        $this->hash_aluno = $hash;
        $this->aluno = Aluno::where('hash', $this->hash_aluno)->first();
        $this->pessoa = Pessoa::find($this->aluno->pessoa_id);

        $this->nome = $this->pessoa->nome;
        $this->email = $this->pessoa->email;
        $this->num_documento = $this->pessoa->num_documento;
        $this->telefone1 = $this->pessoa->telefone1;
        $this->telefone2 = $this->pessoa->telefone2;
        $this->genero = $this->pessoa->genero;
        $this->num_cedula = $this->aluno->num_cedula_advogado;
    
    }

    public function render()
    {
        $this->aluno = Aluno::where('hash', $this->hash_aluno)->first();
        $this->pessoa = Pessoa::find($this->aluno->pessoa_id);
        return view('dashboard.revisor.antigos-actualizar')->extends('layouts.app')->section('conteudo');
    }

    public function salvar_dados()
    {

        if ($this->nome == null || $this->nome == '') {
            $this->mensagem('Digite o nome do formando', 'warning');
        } else if ($this->email == null || $this->email == '') {
            $this->mensagem('Digite o email do formando', 'warning');
        } else if ($this->telefone1 == null || $this->telefone1 == '') {
            $this->mensagem('Digite o nº de telefone principal', 'warning');
        } else if ($this->telefone2 == null || $this->telefone2 == '') {
            $this->mensagem('Digite o nº de telefone alternativo', 'warning');
        } else if ($this->num_cedula == null || $this->num_cedula == '') {
            $this->mensagem('Digite o nº da cédula do formando', 'warning');
        } else if ($this->genero == null) {
            $this->mensagem('Informe o género do formando', 'warning');
        } else if ($this->num_documento == null || $this->num_documento == '') {
            $this->mensagem('Digite o nº do bilhete do formando', 'warning');
        } else {

            $encoding = mb_internal_encoding();
            $this->pessoa->nome = mb_strtoupper($this->nome, $encoding);
            $this->pessoa->email = strtolower($this->email);
            $this->pessoa->telefone1 = $this->telefone1;
            $this->pessoa->telefone2 = $this->telefone2;
            $this->pessoa->documento = "Bilhete de Identidade";
            $this->pessoa->genero = $this->genero;
            $this->pessoa->num_documento = $this->num_documento;
            $this->pessoa->save();

            $this->aluno->num_cedula_advogado = $this->num_cedula;
            $this->aluno->save();

            $this->mensagem('Informações actualizadas com sucesso', 'success');

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

}
