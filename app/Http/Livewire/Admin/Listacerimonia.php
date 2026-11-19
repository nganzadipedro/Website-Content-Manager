<?php

namespace App\Http\Livewire\Admin;

use App\Models\Estagiariospatrono;
use App\Models\Inscricaoadvogado;
use App\Models\Platform\Advogado;
use App\Models\Registoentrada;
use Auth;
use Livewire\Component;

class Listacerimonia extends Component
{

    public $categoria_p;
    public $categoria_nome;

    public $lista_advogados = array();

    public function mount($categoria)
    {
        $this->categoria_p = $categoria;
        if ($this->categoria_p == 'Advogado') {
            $this->categoria_nome = 'Advogados';
        } else {
            $this->categoria_nome = 'Advogados Estagiários';
        }
    }

    public function render()
    {

        $this->lista_advogados = Advogado::join('pessoa', 'pessoa.id', 'app_advogado.pessoa_id')
            ->where('app_advogado.estado', 'Aguarda Cerimónia')
            ->where('app_advogado.categoria', $this->categoria_p)
            ->where('app_advogado.presenca_cerimonia', 'Presente')
            ->orderBy('pessoa.nome')
            ->select('app_advogado.*', 'pessoa.id as id_pessoa')
            ->get();

        if ($this->categoria_p == 'Estagiario') {
            // foreach ($this->lista_advogados as $advogado) {

            //     set_time_limit(0);

            //     $registo = Registoentrada::where('proveniencia', $advogado->getpessoa->nome)->first();

            //     if ($registo) {
            //         $insc = Inscricaoadvogado::where('registo_entrada_id', $registo->id)->first();

            //         if ($insc) {

            //             if ($insc->patrono_id != null) {
            //                 $est_pat = Estagiariospatrono::where('patrono_id', $insc->patrono_id)
            //                     ->where('inscricao_advogado_id', $insc->id)
            //                     ->first();

            //                 if ($est_pat) {
            //                     $est_pat->estagiario_id = $advogado->id;
            //                     $est_pat->save();
            //                 }
            //             } else {
            //                 echo $registo->proveniencia . ' - ' . $advogado->nome_patrono . '<br>';
            //             }

            //         }
            //     }
            // }
        }

        if (Auth::user()->permissao_id == 3) {
            return view('dashboard.areatecnica.listar-aguarda-cerimonia')->extends('layouts-new.app')->section('content');
        }

    }

    public function updatedCategoria($valor)
    {

        $this->lista_advogados = Advogado::join('pessoa', 'pessoa.id', 'app_advogado.pessoa_id')
            ->where('app_advogado.estado', 'Aguarda Cerimónia')
            ->where('app_advogado.categoria', $valor)
            ->orderBy('pessoa.nome')
            ->select('app_advogado.*', 'pessoa.id as id_pessoa')
            ->get();

        // $this->resetPage();  se estiver usando paginação
    }

    public function _pegaregistoentrada($nome)
    {
        $registo = Registoentrada::where('proveniencia', $nome)->first();
        if ($registo) {
            return $registo->id;
        }
    }
}
