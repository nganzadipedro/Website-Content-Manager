<?php

namespace App\Http\Livewire\Geral;

use App\Http\Controllers\ActividadesistemaController;
use App\Models\Enoaa\Ano;
use App\Models\Fio\Candidaturaformacao;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Pendentes extends Component
{

    public $candidaturas = array();
    public $homens;
    public $mulheres;
    public $tipo;

    public function mount($tipo)
    {
        $this->tipo = $tipo;
    }

    public function render()
    {
        $ano = Ano::where('estado', 'Activo')->first();
        $this->candidaturas = Candidaturaformacao::where('estado', 'pendente')
            ->where('pintar', 'Não')
            ->where('year_id', $ano->id)
            ->get();


        if (Auth::user()->permission_id == 4) {
            $this->candidaturas = Candidaturaformacao::where('estado', 'pendente')
                ->where('pintar', 'Não')
                ->where('year_id', $ano->id)
                ->where('prov_formacao_id', Auth::user()->provincia_id)
                ->get();
        }

        $this->homens = 0;
        $this->mulheres = 0;

        if (count($this->candidaturas) > 0) {
            foreach ($this->candidaturas as $item) {
                if ($item->getPessoa->genero == 'Masculino') {
                    $this->homens++;
                } else {
                    $this->mulheres++;
                }
            }
        }

        if ($this->tipo == 'fem') {
            return view('dashboard.candidaturas.pendentes')->extends('layouts.app')->section('conteudo');
        } else {
            return view('dashboard.candidaturas.pendentes-masc')->extends('layouts.app')->section('conteudo');
        }

    }

    public function destacar($id)
    {

        $candidatura = Candidaturaformacao::find($id);
        $candidatura->pintar = 'Sim';
        $candidatura->save();

        // gerar historico
        ActividadesistemaController::inserir(Auth::id(), "Destacou a candidatura", 'CEF', 'candidatura', $candidatura->id);
        $this->mensagem('Candidatura destacada com sucesso', 'success');
    }

    public function remover_destaque($id)
    {

        $candidatura = Candidaturaformacao::find($id);
        $candidatura->pintar = 'Não';
        $candidatura->save();
        // gerar historico
        ActividadesistemaController::inserir(Auth::id(), "Removeu o destaque na candidatura", 'CEF', 'candidatura', $candidatura->id);

        $this->mensagem('Destaque removido com sucesso', 'success');
    }

    private function mensagem($msg, $icon)
    {
        $this->dispatchBrowserEvent('swal', [
            'title' => $msg,
            'timer' => 5000,
            'icon' => $icon,
            // 'toast' => true,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
            'position' => 'center'
        ]);
    }
}
