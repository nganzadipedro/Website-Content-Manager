<?php

namespace App\Lib\Repositories;

use Exception, Throwable;
use App\Models\Enterprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lib\Traits\EnterpriseTrait;
use App\Lib\Interfaces\UserInterface;
use App\Models\GrupoSanguineo;
use App\Models\Pais;
use App\Models\Permission;
use App\Models\Provincia;
use App\Models\User;

class ProvinciaRepository
{
   

    #pega todas as empresas
    public function getAllProvincias()
    {
        $provincias = Provincia::all();
        return $provincias;
    }

    public function getProvinciaById($id)
    {
        $provincia = Provincia::findOrFail($id);
        return $provincia;
    }

   

}
