<?php

namespace App\Http\Livewire\Secretaria;

use App\Http\Livewire\Admin\Atribuiradvogado;
use App\Models\Advogadoatribuido;
use App\Models\Registoentrada;
use Livewire\Component;

class Documentoassistencia extends Component
{

    public $registo;
    public $registo_hash;
    public $nome_advogado;
    public $telefone_advogado;
    public $email_advogado;
    public $categoria_advogado;
    public $advogado_atribuido;

    public $tipo_situacao;

    public function mount($hash)
    {
        $this->registo_hash = $hash;
        $this->registo = Registoentrada::where('hash', $this->registo_hash)->first();
        $this->advogado_atribuido = Advogadoatribuido::where('registo_entrada_id', $this->registo->id)->first();

        if ($this->advogado_atribuido) {
            if ($this->advogado_atribuido->advogado_id != null) {
                $this->nome_advogado = $this->advogado_atribuido->getadvogado->getpessoa->nome;
                $this->telefone_advogado = $this->advogado_atribuido->getadvogado->getpessoa->telefone;
                $this->email_advogado = $this->advogado_atribuido->getadvogado->getpessoa->email;
                $this->categoria_advogado = $this->advogado_atribuido->getadvogado->categoria;
            } else {
                $this->nome_advogado = $this->advogado_atribuido->nome_completo;
                $this->telefone_advogado = $this->advogado_atribuido->telefone;
                $this->email_advogado = $this->advogado_atribuido->email;
                $this->categoria_advogado = $this->advogado_atribuido->categoria;
            }
        } else {
            $this->nome_advogado = 'Não atribuído';
            $this->telefone_advogado = 'Não atribuído';
            $this->email_advogado = 'Não atribuído';
            $this->categoria_advogado = 'Não atribuído';
        }
    }
    public function render()
    {
        return view('dashboard.secretaria.documento-assistencia')->extends('layouts-new.app')->section('content');
    }
}
