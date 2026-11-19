<?php

namespace App\Lib\Repositories;

use Exception, Throwable;
use App\Models\Enterprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lib\Traits\EnterpriseTrait;
use App\Lib\Interfaces\UserInterface;
use App\Models\Permission;
use App\Models\User;

class PermissionRepository
{
   

    #pega todas as empresas
    public function getAllPermissions()
    {
        $permissions = Permission::all();

        return $permissions;
    }

   

}
