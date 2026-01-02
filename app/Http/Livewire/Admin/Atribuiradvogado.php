<?php

namespace App\Http\Livewire\Admin;

use App\Http\Controllers\ActividadesistemaController;
use App\Models\Advogadoatribuido;
use App\Models\Platform\Advogado;
use App\Models\Registoentrada;
use Auth;
use Livewire\Component;

class Atribuiradvogado extends Component
{

    public $hash_registo;
    public $registo;
    public $lista_advogados = array();
    public $advogado_selecionado;
    public $outro_advogado = false;

    public $observacao;
    public $telefone;
    public $email;
    public $nome_completo;
    public $cedula;


    public function mount($hash)
    {
        $this->hash_registo = $hash;
        $this->registo = Registoentrada::where('hash', $this->hash_registo)->first();
    }
    public function render()
    {
        $this->lista_advogados = Advogado::join('pessoa', 'app_advogado.pessoa_id', 'pessoa.id')
            ->where('app_advogado.categoria', 'Advogado')
            ->orderBy('pessoa.nome', 'asc')
            ->select('app_advogado.*')->get();
        return view('dashboard.admin.atribuir-advogado')->extends('layouts-new.app')->section('content');
    }

    public function escolherAdvogado($advogado_id)
    {
        if ($this->advogado_selecionado != null) {
            $this->advogado_selecionado = null;
            $this->mensagem('Já existe um advogado selecionado', 'warning');
        } else {
            $this->advogado_selecionado = Advogado::find($advogado_id);
            $this->outro_advogado = false;
        }

    }

    public function atribuir_outro()
    {
        $this->advogado_selecionado = null;
        $this->outro_advogado = true;
    }

    public function confirmar_atribuicao()
    {
        if ($this->advogado_selecionado == null && $this->outro_advogado == false) {
            $this->mensagem('Selecione um advogado ou escolha atribuir outro advogado', 'warning');
        } else {
            if ($this->outro_advogado == true) {

                if ($this->nome_completo == null || $this->nome_completo == '') {
                    $this->mensagem('Informe o nome completo do advogado', 'warning');
                } else if ($this->cedula == null || $this->cedula == '') {
                    $this->mensagem('Informe a cédula profissional do advogado', 'warning');
                } else if ($this->telefone == null || $this->telefone == '') {
                    $this->mensagem('Informe o telefone do advogado', 'warning');
                } else if ($this->email == null || $this->email == '') {
                    $this->mensagem('Informe o email do advogado', 'warning');
                } else {

                    $atribuicao = Advogadoatribuido::create([
                        'registo_entrada_id' => $this->registo->id,
                        'observacao' => $this->observacao,
                        'telefone' => $this->telefone,
                        'email' => $this->email,
                        'cedula' => $this->cedula,
                        'nome_completo' => $this->nome_completo,
                        'user_id' => auth()->user()->id
                    ]);

                    $this->registo->estado = 'deferido';
                    $this->registo->encaminhado = 'Área Técnica';
                    $this->registo->save();

                    $msg = "Atribuiu um advogado para o processo de assistência jurídica ($this->nome_completo)";
                    ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $this->registo->id);
                    ActividadesistemaController::inserir(Auth::id(), $msg, 'user', Auth::id());

                    $this->mensagemRefresh('Advogado atribuído com sucesso', 'success');
                }
            } else {

                if ($this->advogado_selecionado->getpessoa->telefone1 == null && $this->telefone == null) {
                    $this->mensagem('O advogado selecionado não possui telefone cadastrado. Por favor, informe o telefone para contacto.', 'warning');
                } else if ($this->advogado_selecionado->getpessoa->email == null && $this->email == null) {
                    $this->mensagem('O advogado selecionado não possui email cadastrado. Por favor, informe o email para contacto.', 'warning');
                } else {

                    $atribuicao = Advogadoatribuido::create([
                        'registo_entrada_id' => $this->registo->id,
                        'advogado_id' => $this->advogado_selecionado->id,
                        'observacao' => $this->observacao,
                        'telefone' => $this->telefone,
                        'email' => $this->email,
                        'user_id' => auth()->user()->id
                    ]);

                    $this->registo->estado = 'deferido';
                    $this->registo->encaminhado = 'Área Técnica';
                    $this->registo->save();

                    $msg = "Atribuiu um advogado para o processo de assistência jurídica" . $this->advogado_selecionado->getpessoa->nome;
                    ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $this->registo->id);
                    ActividadesistemaController::inserir(Auth::id(), $msg, 'user', Auth::id());
                    $this->mensagemRefresh('Advogado atribuído com sucesso', 'success');
                }

            }
        }
    }

    private function mensagem($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal2', [
            'title' => '',
            'text' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            'toast' => false,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'center'
        ]);
    }

    private function mensagemRefresh($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal', [
            'title' => '',
            'text' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            'toast' => false,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'center'
        ]);
    }
}
