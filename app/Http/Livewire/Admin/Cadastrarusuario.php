<?php

namespace App\Http\Livewire\Admin;

use App\Models\Permissao;
use App\Models\Pessoa;
use App\Models\User;
use Hash;
use Livewire\Component;

class Cadastrarusuario extends Component
{

    public $permissoes = array();
    public $nome_completo;
    public $genero;
    public $email;
    public $telefone1;
    public $telefone2;
    public $nivel_acesso;
    public $documento;
    public $num_documento;


    protected $rules = [
        'nome_completo' => 'required',
        'email' => 'required|email|unique:pessoa',
        'genero' => 'required',
        'documento' => 'required',
        'num_documento' => 'required|unique:pessoa',
        'telefone1' => 'required|unique:pessoa',
        'telefone2' => 'required|unique:pessoa',
        'nivel_acesso' => 'required',
    ];

    public function render()
    {
        $this->permissoes = Permissao::all();
        return view('dashboard.admin.cadastrar-usuario')->extends('layouts.main')->section('content');
    }

    public function salvar()
    {

        session()->forget('message');
        $this->validate($this->rules);

        $pessoa = Pessoa::create([
            'nome' => strtoupper($this->nome_completo),
            'genero' => $this->genero,
            'documento' => $this->documento,
            'num_documento' => $this->num_documento,
            'telefone1' => $this->telefone1,
            'telefone2' => $this->telefone2,
            'email' => $this->email
        ]);

        $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%&*()-_=+";
        $senha = "";

        for ($i = 0; $i < 10; $i++) {
            $senha .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }

        $user = User::create([
            'pessoa_id' => $pessoa->id,
            'permissao_id' => $this->nivel_acesso,
            'two_factor' => 'não',
            'estado' => 'ativo',
            'password' => Hash::make($senha)
        ]);

        $this->nome_completo = null;
        $this->genero = null;
        $this->email = null;
        $this->telefone1 = null;
        $this->telefone2 = null;
        $this->nivel_acesso = null;
        $this->documento = null;
        $this->num_documento = null;

        session()->flash('message', 'Usuário cadastrado com sucesso!');

    }
}
