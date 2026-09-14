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
            'estado' => 'deferido',
            'tipo_situacao_assistencia' => $registo_entrada->tipo_situacao_assistencia == null ? $request->tipo_situacao : $registo_entrada->tipo_situacao_assistencia,
            'tipo_indicacao' => $registo_entrada->tipo_indicacao == null ? $request->tipo_indicacao : $registo_entrada->tipo_indicacao
        ]);

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
