<?php

namespace App\Http\Livewire\Admin;

use App\Http\Controllers\ActividadesistemaController;
use App\Models\Advogadoatribuido;
use App\Models\Pedidointervencao;
use App\Models\Platform\Advogado;
use App\Models\Registoentrada;
use Auth;
use Livewire\Component;

class Atribuiradvogado extends Component
{

    public $hash_registo;
    public $registo;
    public $lista_advogados = array();
    public $advogados_atribuidos = array();
    public $lista_advogados_geral = array();
    public $advogado_selecionado = null;
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
        $this->lista_advogados_geral = Advogado::join('pessoa', 'app_advogado.pessoa_id', 'pessoa.id')
            ->where('app_advogado.categoria', 'Advogado')
            ->orWhere('app_advogado.categoria', 'Estagiario')
            ->orderBy('pessoa.nome', 'asc')
            ->select('app_advogado.*')->get();

        $this->lista_advogados = Pedidointervencao::all();
        $this->advogados_atribuidos = Advogadoatribuido::where('registo_entrada_id', $this->registo->id)->get();
        return view('dashboard.admin.atribuir-advogado')->extends('layouts-new.app')->section('content');
    }

    public function confirmar_atribuicao()
    {

        $conta = Advogadoatribuido::where('registo_entrada_id', $this->registo->id)->count();

        if ($conta == 0) {

            $this->mensagem('Não foi atribuido nenhum advogado para este processo', 'warning');

        } else {

            $this->registo->estado = 'deferido';
            $this->registo->encaminhado = 'Área Técnica';
            $this->registo->save();

            $this->mensagemRefresh('Processo de atribuição de advogados terminado com sucesso', 'success');
            return redirect()->route('system.admin.list_assistencia', 'solved');

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
