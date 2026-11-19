<?php

namespace App\Http\Livewire\Admin\Usuarios;

use App\Http\Controllers\ActividadesistemaController;
use App\Http\Controllers\MailController;
use App\Models\Enoaa\Ano;
use App\Models\Enoaa\Permissao;
use App\Models\Enoaa\Pessoa;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Fio\Formacao;
use App\Models\Fio\Professor;
use App\Models\Fio\Turma;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cadastrar extends Component
{
    public $categorias = array();
    public $nome;
    public $documento;
    public $num_documento;
    public $tel1;
    public $tel2;
    public $genero;
    public $email;
    public $categoria_id;
    public $ativo;
    public $turmas = array();
    public $turma_id;

    public function render()
    {
        $this->categorias = Permissao::all();
        $this->turmas = Turma::all();
        return view('dashboard.admin.usuarios.cadastrar')->extends('layouts.app')->section('conteudo');
    }

    public function salvar()
    {


        $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%&*()-_=+";
        $senha = "";

        for ($i = 0; $i < 10; $i++) {
            $senha .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }

        // $senha = "admin";

        $valida = $this->validaDados($this->num_documento, $this->email, $this->tel1, $this->tel2);
        if ($valida == 'documento') {
            $this->mensagem('Nº de bilhete já existe', 'warning');
        } else if ($valida == 'email') {
            $this->mensagem('Email já existe', 'warning');
        } else if ($valida == 'telefone1') {
            $this->mensagem('O telefone principal já existe', 'warning');
        } else if ($valida == 'telefone2') {
            $this->mensagem('O telefone alternativo já existe', 'warning');
        } else {

            if ($this->categoria_id == 5 && ($this->turma_id == null || $this->turma_id == '')) {
                $this->mensagem('Indique a turma para o candidato', 'warning');
            } else {

                $encoding = mb_internal_encoding();
                $pessoa = new Pessoa();
                $pessoa->nome = mb_strtoupper($this->nome, $encoding);
                $pessoa->telefone1 = $this->tel1;
                $pessoa->telefone2 = $this->tel2;
                $pessoa->genero = $this->genero;
                $pessoa->email = $this->email;
                $pessoa->documento = $this->documento;
                $pessoa->num_documento = $this->num_documento;
                $pessoa->save();
                $idpessoa = $pessoa->id;

                $usuario = new User();
                $usuario->pessoa_id = $idpessoa;
                $usuario->ativo = $this->ativo;
                $usuario->acesso_fio = 'Sim';
                $usuario->acesso_enoaa = 'Não';
                $usuario->primeiro_acesso = "Sim";
                $usuario->password = md5($senha);
                $usuario->permission_id = $this->categoria_id;
                $usuario->save();
                $usuario->hash = md5($usuario->id . $senha);
                $usuario->save();

                // se o usuário é professor
                if ($this->categoria_id == 6) {
                    $r = Professor::create([
                        'pessoa_id' => $pessoa->id
                    ]);
                }

                // se o usuário é candidato
                if ($this->categoria_id == 5) {

                    $ano_activo = Ano::where('estado', 'Activo')->first();

                    // formação em que se inscreveu
                    $turma_inscrito = Turma::find($this->turma_id);
                    $form_inscrito = Formacao::find($turma_inscrito->formacao_id);

                    $candidatura = Candidaturaformacao::create([
                        'pessoa_id' => $idpessoa,
                        'year_id' => $ano_activo->id,
                        'formacao_id' => $form_inscrito->id,
                        'pintar' => 'Não',
                        'estado' => 'aprovado',
                        'turma_id' => $this->turma_id,
                        'pago' => 'não pago'
                    ]);

                    $codigo = 'FIO' . $candidatura->id . '-' . $ano_activo->descricao;
                    $candidatura->codigo = $codigo;
                    $candidatura->hash = md5($codigo . $pessoa->id . $pessoa->num_documento);
                    $candidatura->save();
                
                }

                ActividadesistemaController::inserir(Auth::id(), "Cadastrou um novo usuário ($this->nome)", 'Usuário', 'conta');
                $ob = new MailController();
                $res = $ob->mailUsuario($this->email, $this->nome, $this->tel1, $this->num_documento, $senha);
                $this->mensagemRefresh("Operação realizada com sucesso", 'success');

            }

        }
    }

    public function validaDados($documento, $email, $tel, $tel2)
    {
        $result = Pessoa::where('num_documento', $documento)->where('num_documento', '!=', null)->first();
        if ($result != null) {
            return 'documento';
        } else {
            $result = Pessoa::where('email', $email)->first();
            if ($result != null) {
                return 'email';
            } else {
                $result = Pessoa::where('telefone1', $tel)->first();
                if ($result != null) {
                    return 'telefone1';
                } else {
                    $result = Pessoa::where('telefone2', $tel)->first();
                    if ($result != null) {
                        return 'telefone1';
                    } else {
                        if ($tel2 != null && $tel2 != '') {
                            $result = Pessoa::where('telefone1', $tel2)->first();
                            if ($result != null) {
                                return 'telefone2';
                            } else {
                                $result = Pessoa::where('telefone2', $tel2)->first();
                                if ($result != null) {
                                    return 'telefone2';
                                }
                            }
                        }
                    }
                }
            }
        }
        return 'true';
    }

    private function mensagemRefresh($msg, $icon)
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

    private function mensagem($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal2', [
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
