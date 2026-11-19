<?php

namespace App\Lib\Repositories;

use Exception, Throwable;
use App\Models\Enterprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lib\Traits\EnterpriseTrait;
use App\Lib\Interfaces\UserInterface;
use App\Models\Disciplina;
use App\Models\GrupoSanguineo;
use App\Models\Pais;
use App\Models\Permission;
use App\Models\Provincia;
use App\Models\User;

class DisciplinaRepository
{
   

    #pega todas as empresas
    public function getAll()
    {
        $disciplinas = Disciplina::all();
        return $disciplinas;
    }

    public function getDisciplinaById($id)
    {
        $disciplina = Disciplina::findOrFail($id);
        return $disciplina;
    }

   

}
