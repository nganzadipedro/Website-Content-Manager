<?php

namespace App\Lib\Repositories;

use Exception, Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lib\Traits\UserTrait;
use App\Models\Candidato;
use App\Models\Year;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidatura;
use App\Models\ExameCandidato;
use App\Models\UserCandidato;

class ExameCandidatoRepository
{

    use UserTrait;

    public function insert($candidato, $ano)
    {

        DB::beginTransaction();
        try {

            $exame_candidato = ExameCandidato::create([
                "candidato_id"   => $candidato,
                "year_id"   => $ano
            ]);

            DB::commit();
            return $exame_candidato;
        } catch (Throwable $error) {
            DB::rollBack();
            throw new Exception($error);
        }
    }

}
