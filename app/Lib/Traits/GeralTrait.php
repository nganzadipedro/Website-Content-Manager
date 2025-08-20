<?php

namespace App\Lib\Traits;

use App\Models\Ano;
use App\Models\Instituicao;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

trait GeralTrait
{
    protected function getAllInstituicao()
    {
        $instuicoes = Instituicao::all();
        return $instuicoes;
    }

    protected function getAnoActivo()
    {
        $result = Ano::where("estado", "=", "1")->first();
        return $result->descricao;
    }

    protected function getIdAnoActivo()
    {
        $result = Ano::where("estado", "=", "1")->first();
        return $result->id;
    }

}