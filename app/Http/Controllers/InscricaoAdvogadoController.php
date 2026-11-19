<?php

namespace App\Http\Controllers;

use App\Models\Inscricaoadvogado;
use App\Models\Registoentrada;
use Auth;
use Illuminate\Http\Request;

class InscricaoAdvogadoController extends Controller
{

    public function detele_grupo_post(Request $request)
    {
        date_default_timezone_set("Africa/Luanda");
        $selecionados = $request->selecionados;

        foreach ($selecionados as $linha) {

            $i = Inscricaoadvogado::find($linha);
            $r = Registoentrada::find($i->registo_entrada_id);
            $codigo = $i->codigo;

            ActividadesistemaController::inserir(Auth::id(), "O processo de inscrição ($codigo) foi excluído da base de dados.", 'registo-entrada', $r->id);
            ActividadesistemaController::historico_processo("O processo de inscrição ($codigo) foi excluído da base de dados.", $r->id);

            $i->delete();
            $r->delete();
        }

        return 'sucesso';
    }

    public function consulta_processo_inscricao(Request $request)
    {
        $codigo = $request->codigo;
        $inscricao = Inscricaoadvogado::where('codigo', $codigo)->first();
        if ($inscricao) {
            $registo = Registoentrada::find($inscricao->registo_entrada_id);
            $estado = $inscricao->estado;
            if ($estado == 'em tratamento' && $inscricao->acto_pretendido == 'Indicação de Patrono') {
                $estado = 'Indicação de Patrono';
            } else if ($estado == 'Sobre a mesa do Presidente' && $inscricao->acto_pretendido == 'Indicação de Patrono') {
                $estado = 'Indicação de Patrono';
            } else if ($estado == 'em tratamento' && $inscricao->despacho == 'Indeferido') {
                $estado = 'Indeferido';
            } else if ($estado == 'em tratamento' && $inscricao->tipo_processo_id == 2 && $inscricao->estado_distribuicao == 'Por Distribuir') {
                $estado = 'Mapa de Distribuição';
            }
            return response()->json([
                'codigo' => 200,
                'mensagem' => 'O processo foi encontrado.',
                'processo' => $inscricao,
                'registo' => $registo,
                'estado' => $estado
            ], 200);
        } else {
            return response()->json([
                'codigo' => 500,
                'mensagem' => 'O processo não foi encontrado.'
            ], 500);
        }
    }


    public function novo_codigo()
    {

        $inscricoes = Inscricaoadvogado::all();
        foreach ($inscricoes as $linha) {

            set_time_limit(0);

            $codigo = $linha->codigo;
            $new_codigo = '';
            if (str_contains($codigo, 'IA') == false) {
                if ($linha->tipo_processo_id == 2) {

                    $new_codigo = $linha->numero . 'IA/2026';
                    $linha->codigo = $new_codigo;
                    $linha->save();

                } else if ($linha->tipo_processo_id == 3) {

                    $new_codigo = $linha->numero . 'IAE/2026';
                    $linha->codigo = $new_codigo;
                    $linha->save();

                } else {

                    echo $linha->id . 'outro tipo de processo<br><br>';

                }
            }
        }

    }

}
