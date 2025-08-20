<?php

namespace App\Lib\Repositories;

use Exception, Throwable;
use App\Models\Enterprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Candidato;

use App\Models\Year;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidatura;
use App\Models\Curso;
use App\Models\Inscricao;
use App\Models\User;
use App\Models\UserCandidato;
use Illuminate\Support\Facades\Mail;

class CursoRepository
{

    public function getCursoByInstituicao($id)
    {
        $cursos = Curso::where("instituicao_id", "=", "{$id}")
            ->with([
                "unidade"
            ])->get();
        return $cursos;
    }

    public function getCandidatoByHash($hash)
    {
        $candidato = DB::select("select * from vw_candidaturas where hash = '{$hash}'");
        return $candidato != null ? $candidato[0] : null;
    }

    public function getCandidatoLogado()
    {
        $id_user = Auth::user()->id;
        $candidato = UserCandidato::where("user_id", "=", "{$id_user}")->first();
        $candidato = Candidato::where("id", "=", "{$candidato->candidato_id}")->first();
        return $candidato;
    }
}
