<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Inscricaoadvogado;
use App\Models\Registoentrada;
use Auth;
use Livewire\Component;

class Pesquisageral extends Component
{

    public $lista = array();

    public function render()
    {
        $result = Registoentrada::where('tipo_processo_id', 3)
            ->where('encaminhado', 'Área Técnica')
            ->where('estado', 'pendente')
            ->orderBy('id', 'asc')->get();

        foreach ($result as $item) {

            $linha = [];
            $linha[0] = $item->codigo;
            $linha[1] = $item->proveniencia;
            $linha[2] = $item->gettipoprocesso->descricao;
            $linha[3] = $item->data_entrada;
            $linha[4] = 'Pendente';
            $linha[5] = 'Sem Despacho';
            $linha[6] = $item->id;

            array_push($this->lista, $linha);

        }

        $result = Registoentrada::where('tipo_processo_id', 2)
            ->where('encaminhado', 'Área Técnica')
            ->where('estado', 'pendente')
            ->orderBy('id', 'asc')->get();

        foreach ($result as $item) {

            $linha = [];
            $linha[0] = $item->codigo;
            $linha[1] = $item->proveniencia;
            $linha[2] = $item->gettipoprocesso->descricao;
            $linha[3] = $item->data_entrada;
            $linha[4] = 'Pendente';
            $linha[5] = 'Sem Despacho';
            $linha[6] = $item->id;

            array_push($this->lista, $linha);

        }

        $result = Inscricaoadvogado::all();

        foreach ($result as $item) {

            $linha = [];
            $linha[0] = $item->codigo;
            $linha[1] = $item->getregistoentrada->proveniencia;
            $linha[2] = $item->gettipoprocesso->descricao;
            $linha[3] = $item->getregistoentrada->data_entrada;

            $estado = $item->estado;
            if ($estado == 'em tratamento' && $item->acto_pretendido == 'Indicação de Patrono') {
                $estado = 'Indicação de Patrono';
            } else if ($estado == 'Sobre a mesa do Presidente' && $item->acto_pretendido == 'Indicação de Patrono') {
                $estado = 'Indicação de Patrono';
            } else if ($estado == 'em tratamento' && $item->despacho == 'Indeferido') {
                $estado = 'Indeferido';
            } else if ($estado == 'em tratamento' && $item->tipo_processo_id == 2 && $item->estado_distribuicao == 'Por Distribuir') {
                $estado = 'Mapa de Distribuição';
            }

            $linha[4] = $estado;
            $linha[5] = $item->despacho == null ? 'Sem Despacho' : $item->despacho;
            $linha[6] = $item->registo_entrada_id;
            array_push($this->lista, $linha);

        }

        if (Auth::user()->permissao_id == 3) {
            return view('dashboard.areatecnica.pesquisa-geral')->extends('layouts-new.app')->section('content');
        } else {
            return view('dashboard.recepcionista.pesquisa-geral')->extends('layouts-new.app')->section('content');
        }


    }
}
