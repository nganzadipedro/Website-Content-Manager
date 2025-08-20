<?php

namespace App\Http\Controllers;

use App\Models\Historicosistema;
use Auth;
use Illuminate\Http\Request;

class ActividadesistemaController extends Controller
{
    public static function inserir($user = null, $operacao, $destino = null, $destino_id = null)
    {

        $actividade = Historicosistema::create([
            'user_id' => $user == null ? Auth::id() : $user,
            'operacao' => $operacao,
            'destino' => $destino == null ? 'user' : $destino,
            'destino_id' => $destino_id == null ? Auth::id() : $destino_id
        ]);

        return $actividade;

    }
}
