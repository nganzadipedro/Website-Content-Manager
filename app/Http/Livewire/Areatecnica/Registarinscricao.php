<?php

namespace App\Http\Livewire\Areatecnica;

use App\Http\Controllers\ActividadesistemaController;
use App\Models\Advogadoatribuido;
use App\Models\Inscricaoadvogado;
use App\Models\Municipio;
use App\Models\Patrono;
use App\Models\Pedidoassistencia;
use App\Models\Registoentrada;
use Illuminate\Support\Str;
use Auth;
use Livewire\Component;

class Registarinscricao extends Component
{

    public $hash_pedido;
    public $registo;
    public $assunto;
    public $destinatario;
    public $data_entrada;
    public $observacao;
    public $tipo_documento;
    public $proveniencia;

    public $telefone1;
    public $telefone2;
    public $email;

    public $sexo;
    public $natureza;
    public $localizacao;
    public $observacao2;
    public $acto_pretendido;
    public $advogado_atribuido;
    public $nome_advogado;
    public $cedula_advogado;
    public $telefone_advogado;
    public $email_advogado;

    public $municipios = array();

    public $patronos = array();

    public function mount($hash)
    {

        $this->hash_registo = $hash;
        $this->registo = Registoentrada::where('hash', $this->hash_registo)->first();
        $this->assunto = $this->registo->assunto;
        $this->destinatario = $this->registo->destinatario;
        $this->data_entrada = $this->registo->data_entrada;
        $this->observacao = $this->registo->observacao;
        $this->tipo_documento = $this->registo->tipo_documento;
        $this->proveniencia = $this->registo->proveniencia;

    }
    public function render()
    {

        $this->municipios = Municipio::all();
        $this->patronos = Patrono::all();
        if ($this->registo->tipo_processo_id == 3) {
            return view('dashboard.areatecnica.registar-inscricao-estagiario')->extends('layouts-new.app')->section('content');
        }
        return view('dashboard.areatecnica.registar-inscricao')->extends('layouts-new.app')->section('content');
    }

    public function salvar()
    {

        if ($this->sexo == '' || $this->sexo == null) {
            $this->mensagem('Informe o sexo', 'warning');
        } else if ($this->telefone1 == '' || $this->telefone1 == null) {
            $this->mensagem('Informe o nº de telefone principal', 'warning');
        } else if ($this->telefone2 == '' || $this->telefone2 == null) {
            $this->mensagem('Informe o nº de telefone alternativo', 'warning');
        } else if ($this->email == '' || $this->email == null) {
            $this->mensagem('Informe o email', 'warning');
        } else if ($this->registo->tipo_processo_id == 3 && ($this->acto_pretendido == '' || $this->acto_pretendido == null)) {
            $this->mensagem('Informe o acto pretendido', 'warning');
        } else {

            $this->registo->estado = 'em tratamento';
            $this->registo->save();

            $numero = '';
            if ($this->registo->tipo_processo_id == 2) {
                $numero = Inscricaoadvogado::where('tipo_processo_id', 2)->whereYear('created_at', now()->year)->count() + 1;
            } else {
                $numero = Inscricaoadvogado::where('tipo_processo_id', 3)->whereYear('created_at', now()->year)->count() + 1;
            }

            $inscricao = Inscricaoadvogado::create([
                'hash' => Str::uuid(),
                'numero' => $numero,
                'codigo' => "$numero/" . now()->year,
                'observacao' => $this->observacao2,
                'tipo_processo_id' => $this->registo->tipo_processo_id,
                'sexo' => $this->sexo == null ? 'Não Definido' : $this->sexo,
                'telefone1' => $this->telefone1,
                'telefone2' => $this->telefone2,
                'email' => $this->email,
                'acto_pretendido' => $this->acto_pretendido,
                'registo_entrada_id' => $this->registo->id,
                'user_id' => Auth::user()->id
            ]);

            $msg = "Processo de inscrição registado pela área técnica.";
            ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $this->registo->id);
            ActividadesistemaController::inserir(Auth::id(), "Registou o processo de inscrição ($inscricao->id)", 'user', $inscricao->id);
            $this->mensagem($msg, 'success');
            return redirect()->route('system.areatecnica.listar_advogados_pendentes');

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
