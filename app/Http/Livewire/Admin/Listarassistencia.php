<?php

namespace App\Http\Livewire\Admin;

use App\Models\Advogadoatribuido;
use App\Models\Documentoaj;
use App\Models\Pedidoassistencia;
use App\Models\Registoentrada;
use Auth;
use Livewire\Component;

class Listarassistencia extends Component
{

    public $tipo;
    public $lista = array();

    public function mount($tipo)
    {
        $this->tipo = $tipo;
    }
    public function render()
    {
        if ($this->tipo == 'not-solved') {
            $this->lista = Registoentrada::
                where('tipo_processo_id', 1)
                ->whereIn('estado', ['pendente', 'entrada'])
                ->orderBy('id', 'desc')
                ->get();
            if (Auth::user()->permissao_id == 2) {
                return view('dashboard.secretaria.aj-pendentes')->extends('layouts-new.app')->section('content');
            }
            return view('dashboard.admin.aj-pendentes')->extends('layouts-new.app')->section('content');
        } elseif ($this->tipo == 'solved') {
            $this->lista = Registoentrada::where('encaminhado', 'Secretaria')
                ->where('estado', 'em tratamento')
                ->where('tipo_processo_id', 1)->orderBy('id', 'desc')->get();
            if (Auth::user()->permissao_id == 2) {
                return view('dashboard.secretaria.aj-deferidos')->extends('layouts-new.app')->section('content');
            }
            return view('dashboard.admin.aj-deferidos')->extends('layouts-new.app')->section('content');
        } elseif ($this->tipo == 'documents') {
            $this->lista = Pedidoassistencia::orderBy('id', 'desc')->get();
            if (Auth::user()->permissao_id == 2) {
                return view('dashboard.secretaria.aj-documentos')->extends('layouts-new.app')->section('content');
            }
            return view('dashboard.admin.aj-documentos')->extends('layouts-new.app')->section('content');
        }
    }

    public function tem_advogados($id)
    {
        $res = Advogadoatribuido::where('registo_entrada_id', $id)->get();
        if (count($res) > 0) {
            return 'true';
        }
        return 'false';
    }
}
