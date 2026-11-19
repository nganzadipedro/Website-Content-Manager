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

class RegistoEntradaController extends Controller
{
    public function get_registo_bycode_post(Request $request)
    {

        $codigo = $request->num_processo;
        if (str_contains($codigo, '/')) {
            $registo_entrada = Registoentrada::where('codigo', $codigo)->first();
            if ($registo_entrada) {
                return $registo_entrada;
            } else {
                return 'nao-encontrado';
            }
        } else {
            return 'codigo-errado';
        }

    }

    public function detele_grupo_post(Request $request)
    {
        date_default_timezone_set("Africa/Luanda");
        $selecionados = $request->selecionados;

        foreach ($selecionados as $linha) {

            $r = Registoentrada::find($linha);
            $codigo = $r->codigo;

            ActividadesistemaController::inserir(Auth::id(), "O processo ($codigo) foi excluído da base de dados.", 'registo-entrada', $r->id);
            ActividadesistemaController::historico_processo("O processo ($codigo) foi excluído da base de dados.", $r->id);

            $r->delete();
        }

        return 'sucesso';
    }

}
