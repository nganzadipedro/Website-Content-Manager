<?php

namespace App\Http\Livewire\Geral;

use App\Models\Enoaa\Ano;
use App\Models\Candidatura;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Fio\Pagamento;
use Auth;
use Livewire\Component;

class Pagas extends Component
{

    public $pagamentos = array();
    public $homens;
    public $mulheres;

    public function render()
    {

        $ano = Ano::where('estado', 'Activo')->first();

        $this->pagamentos = Pagamento::whereYear('created_at', $ano->descricao)->where('emolumento_id', 1)->get();

        $this->homens = 0;
        $this->mulheres = 0;

        foreach ($this->pagamentos as $item) {
            if ($item->getAluno->getPessoa->genero == 'Masculino') {
                $this->homens++;
            } else {
                $this->mulheres++;
            }
        }


        if (Auth::user()->permission_id == 4) {

            $this->pagamentos = Candidaturaformacao::
                where('pago', 'pago')
                ->where('prov_formacao_id', Auth::user()->provincia_id)
                ->get();

            $this->homens = 0;
            $this->mulheres = 0;

            foreach ($this->pagamentos as $item) {
                if ($item->getPessoa->genero == 'Masculino') {
                    $this->homens++;
                } else {
                    $this->mulheres++;
                }
            }

        }

        return view('dashboard.candidaturas.pagas')->extends('layouts.app')->section('conteudo');

    }
}
