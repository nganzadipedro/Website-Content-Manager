<?php

namespace App\Http\Controllers;

use App\Models\Historicoprocesso;
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

    public static function historico_processo($operacao, $registo_id)
    {
        $hist = Historicoprocesso::create([
            'operacao' => $operacao,
            'registoentrada_id' => $registo_id,
            'user_id' =>  Auth::id() 
        ]);

        return $hist;
    }

}
