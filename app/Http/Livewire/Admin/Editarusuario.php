<?php

namespace App\Http\Livewire\Admin;

use App\Http\Controllers\ActividadesistemaController;
use App\Models\Permissao;
use App\Models\Pessoa;
use App\Models\User;
use Livewire\Component;

class Editarusuario extends Component
{

    public $id_user;
    public $permissoes = array();
    public $nome_completo;
    public $genero;
    public $email;
    public $telefone1;
    public $telefone2;
    public $nivel_acesso;
    public $documento;
    public $num_documento;
    public $usuario;
    public $estado_conta;

    protected $rules = [
        'nome_completo' => 'required',
        'email' => 'required|email',
        'genero' => 'required',
        'documento' => 'required',
        'num_documento' => 'required|max:14|min:14',
        'telefone1' => 'required',
        // 'telefone2' => 'required|unique:pessoa',
        'nivel_acesso' => 'required',
    ];

    public function mount($id)
    {
        $this->id_user = $id;
        $this->usuario = User::find($this->id_user);
        $this->nome_completo = $this->usuario->getPessoa->nome;
        $this->genero = $this->usuario->getPessoa->genero;
        $this->email = $this->usuario->getPessoa->email;
        $this->telefone1 = $this->usuario->getPessoa->telefone1;
        $this->telefone2 = $this->usuario->getPessoa->telefone2;
        $this->nivel_acesso = $this->usuario->permissao_id;
        $this->documento = $this->usuario->getPessoa->documento;
        $this->num_documento = $this->usuario->getPessoa->num_documento;
        $this->estado_conta = $this->usuario->estado;

    }
    public function render()
    {
        $this->permissoes = Permissao::all();
        return view('dashboard.admin.editar-usuario')->extends('layouts.main')->section('content');
    }

    public function salvar()
    {

        session()->forget('message');
        $this->validate($this->rules);

        $pessoa = $this->usuario->getPessoa;
        $pessoa->nome = strtoupper($this->nome_completo);
        $pessoa->genero = $this->genero;
        $pessoa->documento = $this->documento;
        $pessoa->num_documento = $this->num_documento;
        $pessoa->telefone1 = $this->telefone1;
        $pessoa->telefone2 = $this->telefone2;
        $pessoa->email = $this->email;
        $pessoa->save();

        $user = $this->usuario;
        $user->permissao_id = $this->nivel_acesso;
        $user->estado = $this->estado_conta;
        $user->save();

        $nome = $this->nome_completo;

        ActividadesistemaController::inserir(null, "Atualizou os dados do usuário:$nome", 'user', $user->id);
        session()->flash('message', 'Dados do usuário atualizados com sucesso!');

    }
}
