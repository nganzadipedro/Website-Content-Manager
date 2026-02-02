<?php

namespace App\Http\Livewire\Admin;

use App\Http\Controllers\MailController;
use App\Models\Pessoa;
use App\Models\User;
use Hash;
use Livewire\Component;

class Detalhesusuario extends Component
{

    public $user_id;
    public $user;
    public $pessoa;

    public function mount($id)
    {
        $this->user_id = $id;

        $this->user = User::find($this->user_id);
        $this->pessoa = Pessoa::find($this->user->pessoa_id);
    }

    public function render()
    {
        return view('dashboard.admin.detalhes-usuario')->extends('layouts-new.app')->section('content');
    }

    public function desactivar()
    {
        $this->user->estado = 'inativo';
        $this->user->save();
        $this->mensagemRefresh('Conta desativada com sucesso!', 'success');
    }

     public function activar()
    {
        $this->user->estado = 'ativo';
        $this->user->save();
        $this->mensagemRefresh('Conta ativada com sucesso!', 'success');
    }

    public function enviar_credenciais()
    {
        $mailController = new MailController();

        $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%&*()-_=+";
        $senha = "";

        for ($i = 0; $i < 10; $i++) {
            $senha .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }

        $this->user->password = Hash::make($senha);
        $this->user->save();    

        // enviar email com as credenciais de acesso
        $res = $mailController->mailCredenciais(
            $this->pessoa->email,
            $this->pessoa->nome,
            $senha,
            $this->user->getPermissao->descricao
        );

        $this->mensagemRefresh('Credenciais enviadas com sucesso!', 'success');
    }   

    private function mensagem($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal2', [
            'title' => '',
            'text' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            'toast' => true,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'top-right'
        ]);
    }

    private function mensagemRefresh($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal', [
            'title' => '',
            'text' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            'toast' => true,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'top-right'
        ]);
    }
}
