<?php

namespace App\Http\Livewire\Admin\Usuarios;

use App\Http\Controllers\ActividadesistemaController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MIMOController;
use App\Http\Controllers\OmbalaController;
use App\Models\Enoaa\Permissao;
use App\Models\Enoaa\Pessoa;
use App\Models\Fio\Candidaturaformacao;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Editar extends Component
{

    public $categorias = array();
    public $usuario;
    public $nome;
    public $documento;
    public $num_documento;
    public $tel1;
    public $tel2;
    public $genero;
    public $email;
    public $categoria_id;
    public $ativo;

    public function mount($hash)
    {

        $this->usuario = User::where('hash', $hash)->first();

        $this->nome = $this->usuario->getPessoa->nome;
        $this->tel1 = $this->usuario->getPessoa->telefone1;
        $this->tel2 = $this->usuario->getPessoa->telefone2;
        $this->documento = $this->usuario->getPessoa->documento;
        $this->num_documento = $this->usuario->getPessoa->num_documento;
        $this->genero = $this->usuario->getPessoa->genero;
        $this->categoria_id = $this->usuario->permission_id;
        $this->email = $this->usuario->getPessoa->email;
        $this->ativo = $this->usuario->ativo;
    }

    public function render()
    {
        $this->categorias = Permissao::all();
        return view('dashboard.admin.usuarios.editar')->extends('layouts.app')->section('conteudo');
    }

    function activar($id)
    {
        $usuario = User::find($id);
        $usuario->ativo = 'Sim';
        $usuario->save();
        $nome = $this->usuario->getPessoa->nome;
        ActividadesistemaController::inserir(Auth::id(), "Activou a conta do usuário $nome", 'CEF', 'conta');
        $this->mensagem('Conta de usuário activado com sucesso', 'success');
    }

    function desativar($id)
    {
        $usuario = User::find($id);
        $usuario->ativo = 'Não';
        $usuario->save();
        $nome = $this->usuario->getPessoa->nome;
        ActividadesistemaController::inserir(Auth::id(), "Desactivou a conta do usuário $nome", 'CEF', 'conta');
        $this->mensagem('Conta de usuário desactivado com sucesso', 'success');
    }

    public function enviar_credencial($id_user)
    {

        $user = User::find($id_user);
        $senha = 'CEF' . $user->pessoa_id . $user->id;
        $senha_cript = md5($senha);
        $user->password = $senha_cript;
        $user->save();

        $nome = $user->getPessoa->nome;
        $telefone = $user->getPessoa->telefone1;
        $email = $user->getPessoa->email;

        $mensagem = "Prezado(a) candidato(a) $nome, seguem as credenciais de acesso a plataforma. Email: $email | Senha: $senha";

        $ob = new OmbalaController();
        $ob->enviarMensagem($telefone, $mensagem);

        $existe = Candidaturaformacao::where('pessoa_id', $user->pessoa_id)->first();
        if ($existe) {
            ActividadesistemaController::inserir(Auth::id(), "Enviou credenciais de acesso ao candidato por SMS", 'CEF', 'candidatura', $existe->id);
            // regista actividade do sistema
            ActividadesistemaController::inserir(null, 'Enviou uma SMS com as credenciais de acesso', 'Sistema', 'candidatura', $existe->id);
        } else {
            ActividadesistemaController::inserir(Auth::id(), "Enviou credenciais de acesso ao usuário ($this->nome)", 'CEF', 'conta');
            ActividadesistemaController::inserir(null, 'Enviou uma SMS com as credenciais de acesso', 'Sistema', 'conta');
        }

        $this->mensagem('credenciais enviadas com sucesso', 'success');

    }

    public function enviar_credencial_email($id_user)
    {

        $user = User::find($id_user);
        //dd($user);
        $senha = 'CEF' . $user->pessoa_id . $user->id;
        $senha_cript = md5($senha);
        $user->password = $senha_cript;
        $user->save();

        $nome = $user->getPessoa->nome;
        $telefone = $user->getPessoa->telefone1;
        $email = $user->getPessoa->email;

        $ob = new MailController();
        $res = $ob->mailCredenciais2($email, $nome, $senha);

        if ($res == true) {
            $this->mensagem('credenciais enviadas com sucesso', 'success');
        } else {
            $this->mensagem('Houve um problema de comunicação ao enviar as credenciais', 'warning');
        }


    }

    public function actualizarDados($id)
    {

        $usuario = User::find($id);
        $pessoa = Pessoa::find($usuario->pessoa_id);

        $valida = $this->validaDados($this->num_documento, $this->email, $this->tel1, $this->tel2, $pessoa->id);
        if ($valida == 'documento') {
            $this->mensagem('Nº de bilhete já existe', 'warning');
        } else if ($valida == 'email') {
            $this->mensagem('Email já existe', 'warning');
        } else if ($valida == 'telefone1') {
            $this->mensagem('O telefone principal já existe', 'warning');
        } else if ($valida == 'telefone2') {
            $this->mensagem('O telefone alternativo já existe', 'warning');
        } else {


            $pessoa->telefone1 = $this->tel1;
            $pessoa->telefone2 = $this->tel2;
            $pessoa->genero = $this->genero;
            $pessoa->email = $this->email;
            $usuario->ativo = $this->ativo;
            $pessoa->save();
            $usuario->save();

            if ($usuario->permission_id != 5) {
                $pessoa->nome = $this->nome;
                $pessoa->documento = $this->documento;
                $pessoa->num_documento = $this->num_documento;
                $usuario->permission_id = $this->categoria_id;
                $pessoa->save();
                $usuario->save();
            }

            ActividadesistemaController::inserir(Auth::id(), "Actualizou os dados do usuário ($this->nome)", 'CEF', 'conta');
            $this->mensagem("Operação realizada com sucesso", 'success');

        }
    }

    public function validaDados($documento, $email, $tel, $tel2, $idpessoa)
    {
        $result = Pessoa::where('num_documento', $documento)->whereNotNull('num_documento')->where('id', '!=', $idpessoa)->first();
        if ($result != null) {
            return 'documento';
        } else {
            $result = Pessoa::where('email', $email)->where('id', '!=', $idpessoa)->first();
            if ($result != null) {
                return 'email';
            } else {
                $result = Pessoa::where('telefone1', $tel)->where('id', '!=', $idpessoa)->first();
                if ($result != null) {
                    return 'telefone1';
                } else {
                    $result = Pessoa::where('telefone2', $tel)->where('id', '!=', $idpessoa)->first();
                    if ($result != null) {
                        return 'telefone1';
                    } else {
                        $result = Pessoa::where('telefone1', $tel2)->where('id', '!=', $idpessoa)->first();
                        if ($result != null) {
                            return 'telefone2';
                        } else {
                            $result = Pessoa::where('telefone2', $tel2)->where('id', '!=', $idpessoa)->first();
                            if ($result != null) {
                                return 'telefone2';
                            }
                        }
                    }
                }
            }
        }
        return 'true';
    }

    private function mensagem($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal', [
            'title' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            'toast' => true,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'top-right'
        ]);
    }
}
