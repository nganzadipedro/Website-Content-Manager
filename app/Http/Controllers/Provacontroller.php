<?php

namespace App\Http\Controllers;

use App\Models\Fio\Prova;
use Illuminate\Http\Request;

class Provacontroller extends Controller
{
    public function gettimeexam($id_prova)
    {

        $prova = Prova::find($id_prova());

        date_default_timezone_set("Africa/Luanda");
        $hora_hoje = date("H:i:s");

        if (strtotime($hora_hoje) < strtotime($prova->hora_fim)) {
            return 'false';
        } else if (strtotime($hora_hoje) >= strtotime($prova->hora_fim)) {
            return 'true';
        }

    }
}
