<?php

namespace App\Http\Livewire\Areatecnica;

use App\Models\Inscricaoadvogado;
use Livewire\Component;

class Advestregistados extends Component
{

    public $categoria_p;

    public function mount($categoria)
    {
        $this->categoria_p = $categoria;
    }
    public function render()
    {

        if ($this->categoria_p == 'Indicacao-Patrono') {

            $this->lista = Inscricaoadvogado::join('registo_entrada', 'registo_entrada.id', 'inscricao_advogado.registo_entrada_id')
                ->where('inscricao_advogado.tipo_processo_id', 3)
                ->where('inscricao_advogado.acto_pretendido', 'Indicação de Patrono')
                ->whereNull('inscricao_advogado.data_remessa_cn')
                ->select('inscricao_advogado.*')
                ->orderBy('registo_entrada.proveniencia', 'asc')->get();
            return view('dashboard.areatecnica.advest-indicacao-patrono')->extends('layouts-new.app')->section('content');

        } else {

            $this->lista = Inscricaoadvogado::join('registo_entrada', 'registo_entrada.id', 'inscricao_advogado.registo_entrada_id')
                ->where('inscricao_advogado.tipo_processo_id', 3)
                ->where('inscricao_advogado.despacho', $this->categoria_p)
                ->where('inscricao_advogado.acto_pretendido', '!=' , 'Indicação de Patrono')
                ->whereNull('inscricao_advogado.data_remessa_cn')
                ->select('inscricao_advogado.*')
                ->orderBy('registo_entrada.proveniencia', 'asc')->get();
            return view('dashboard.areatecnica.advest-registados')->extends('layouts-new.app')->section('content');

        }



    }
}
