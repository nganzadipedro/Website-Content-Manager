<?php

namespace App\Http\Controllers;

use App\Models\Advogadoatribuido;
use App\Models\Carrossel;
use App\Models\Denuncia;
use App\Models\Documentoaj;
use App\Models\Estagiariospatrono;
use App\Models\Galeria;
use App\Models\Mensagem;
use App\Models\Noticia;
use App\Models\Patrono;
use App\Models\Pedidoassistencia;
use App\Models\Platform\Advogado;
use App\Models\Registoentrada;
use App\Models\Relatoriofinanceiro;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

class AssistenciaController extends Controller
{
    public function emitir_documento_post(Request $request)
    {

        $registo_entrada = Registoentrada::find($request->registo_id);

        $pedido = Pedidoassistencia::create([
            'hash' => Str::uuid(),
            'user_id' => Auth::user()->id,
            'insitituicao_copia' => $request->insitituicao_copia == 'undefined' ? null : $request->insitituicao_copia,
            'registo_entrada_id' => $registo_entrada->id,
            'requerente' => $request->requerente,
            'estado' => 'deferido',
            'tipo_situacao_assistencia' => $registo_entrada->tipo_situacao_assistencia == null ? $request->tipo_situacao : $registo_entrada->tipo_situacao_assistencia,
            'tipo_indicacao' => $registo_entrada->tipo_indicacao == null ? $request->tipo_indicacao : $registo_entrada->tipo_indicacao
        ]);


        $ultimoNumero = Pedidoassistencia::whereYear('created_at', now()->year)
            ->max('numero') ?? 0;
        $numero = $ultimoNumero + 1;
        $ano = date("Y");
        $codigo = $numero . "AJ/OAA-CPL/" . $ano;

        $pedido->numero = $numero;
        $pedido->codigo = $codigo;
        $pedido->save();

        if ($registo_entrada->tipo_indicacao == null) {
            $registo_entrada->tipo_indicacao = $request->tipo_indicacao;
            $registo_entrada->save();
        }

        if ($registo_entrada->tipo_situacao_assistencia == null) {
            $registo_entrada->tipo_situacao_assistencia = $request->tipo_situacao;
            $registo_entrada->save();
        }

        $doc = Documentoaj::create([
            'pedido_assistencia_id' => $pedido->id,
            'num_referencia' => $registo_entrada->numero,
            'hash' => Str::uuid(),
            'user_id' => Auth::user()->id,
            'assinado' => 'sim'
        ]);

        $hash_control = explode('-', $doc->hash);
        $hash_control = $hash_control[2] . $pedido->id . $registo_entrada->hash[0] . $registo_entrada->hash[5] . $registo_entrada->hash[7];

        $doc->hash_control = $hash_control;
        $doc->save();

        $registo_entrada->estado = 'deferido';
        $registo_entrada->save();

        return 'sucesso';

    }

    public function emitir_documento_substituicao_post(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        // verificar a referência da assistência inicial
        $referencia_assist_inicial = $request->referencia_assist_inicial;
        $pedido_assistencia = Pedidoassistencia::where('codigo', $referencia_assist_inicial)->first();
        if ($pedido_assistencia == null) {
            // return 'ref-inicial';
        }

        $registo = Registoentrada::find($request->registo_id);
        $registo->estado = 'em tratamento';
        $registo->encaminhado = 'Secretaria';
        $registo->save();

        // atribuicao dos advogados ao processo
        foreach ($request->lista_advogados_adtribuidos as $advogado) {
            $adv_atr = Advogadoatribuido::create([
                'advogado_id' => $advogado,
                'registo_entrada_id' => $registo->id,
                'user_id' => Auth::user()->id
            ]);
        }

        $pedido = Pedidoassistencia::create([
            'hash' => Str::uuid(),
            'user_id' => Auth::user()->id,
            'insitituicao_copia' => $request->insitituicao_copia,
            'registo_entrada_id' => $registo->id,
            'pedido_referencia_id' => $pedido_assistencia == null ? null : $pedido_assistencia->id,
            'requerente' => $request->nome_requerente,
            'advogado_substituido' => $request->advogado_substituido,
            'estado' => 'deferido',
            'tipo_situacao_assistencia' => 'Substituição de Advogado',
            'tipo_indicacao' => $request->tipo_indicacao
        ]);

        $ultimoNumero = Pedidoassistencia::whereYear('created_at', now()->year)
            ->max('numero') ?? 0;
        $numero = $ultimoNumero + 1;
        $ano = date("Y");
        $codigo = $numero . "AJ/OAA-CPL/" . $ano;

        $pedido->numero = $numero;
        $pedido->codigo = $codigo;
        $pedido->save();

        $doc = Documentoaj::create([
            'pedido_assistencia_id' => $pedido->id,
            'hash' => Str::uuid(),
            'user_id' => Auth::user()->id,
            'assinado' => 'sim'
        ]);

        $hash_control = explode('-', $doc->hash);
        $hash_control = $hash_control[2] . $pedido->id . $registo->hash[0] . $registo->hash[5] . $registo->hash[7];

        $doc->hash_control = $hash_control;
        $doc->save();

        $registo->estado = 'deferido';
        $registo->save();

        return 'sucesso';

    }

    public function arquivar_pedido_post(Request $request)
    {

        $pedido = Pedidoassistencia::find($request->pedido_id);
        $registo_entrada = Registoentrada::find($request->registo_id);
        $pedido_referencia = Pedidoassistencia::find($pedido->pedido_referencia_id);

        if ($pedido->pedido_referencia_id != null && $pedido_referencia == null) {
            return 'pedido-referencia';
        }

        $pedido->observacao = $request->observacao;
        $pedido->sexo = $request->sexo;
        $pedido->save();

        if ($pedido->pedido_referencia_id == null) {
            $pedido->natureza = $request->natureza;
            $pedido->localizacao = $request->localizacao;
            $pedido->save();
        } else {
            $pedido->natureza = $pedido_referencia->natureza;
            $pedido->localizacao = $pedido_referencia->localizacao;
            $pedido->save();
        }

        $pedido->estado = 'arquivado';
        $pedido->save();

        $registo_entrada->estado = 'arquivado';
        $registo_entrada->save();

        $msg = "Pedido de assistência arquivado pela Área Técnica.";
        ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_entrada->id);
        ActividadesistemaController::inserir(Auth::id(), "Arquivou o pedido de assistência jurídica ($pedido->id)", 'user', $pedido->id);

        return 'sucesso';

    }

    public function delete_pedido_post(Request $request)
    {

        $pedido = Pedidoassistencia::where('hash', $request->hash_id)->first();
        $doc = Documentoaj::where('pedido_assistencia_id', $pedido->id)->first();

        if ($doc) {
            $doc->delete();
        }
        $pedido->delete();

        $msg = "Pedido de assistência ($pedido->codigo) eliminado pela Secretaria.";
        ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $pedido->registo_entrada_id);
        ActividadesistemaController::inserir(Auth::id(), "Eliminou as informações do pedido de assistência jurídica ($pedido->codigo)", 'user', $pedido->id);

        return 'sucesso';

    }

    public function editar_pedido_post(Request $request)
    {

        $registo_entrada = Registoentrada::find($request->registo_id);
        $pedido = Pedidoassistencia::find($request->pedido_id);

        $pedido->observacao = $request->observacao;
        $pedido->sexo = $request->sexo;
        $pedido->natureza = $request->natureza;
        $pedido->localizacao = $request->localizacao;
        $pedido->estado = 'arquivado';
        $pedido->save();

        $registo_entrada->estado = 'arquivado';
        $registo_entrada->save();

        $msg = "Pedido de assistência actualizado pela Área Técnica.";
        ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_entrada->id);
        ActividadesistemaController::inserir(Auth::id(), "Actualizou as informações do pedido de assistência jurídica ($pedido->id)", 'user', $pedido->id);

        return 'sucesso';

    }

    public function getadvogados_atribuidos($id_registo)
    {
        return response()->json(Advogadoatribuido::where('registo_entrada_id', $id_registo)->get());
    }

    public function getadvogado_atribuido($id_advogado)
    {
        $advogado = Advogado::find($id_advogado);
        $cedula = $advogado->categoria == 'Advogado' ? $advogado->num_associado : $advogado->num_estagiario;
        $nome = $advogado->getpessoa->nome;
        return [
            'cedula' => $cedula,
            'nome' => $nome,
            'categoria' => $advogado->categoria
        ];
    }

    public function get_num_advogados_atribuidos($id_registo)
    {
        return Advogadoatribuido::where('registo_entrada_id', $id_registo)->count();
    }

}
