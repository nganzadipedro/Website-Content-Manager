<?php

namespace App\Lib\Repositories;

use Exception, Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lib\Traits\UserTrait;
use App\Mail\UserMailer;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserRepository
{
    use UserTrait;

    #insere uma nova empresa
    public function createUser(Request $request)
    {

        $password = $this->generatePassword();

        DB::beginTransaction();
        try {

            $user = User::create([
                "nome" => $request->nome,
                "num_bi" => $request->num_bi,
                "email" => $request->email,
                "telefone" => $request->telefone,
                "permission_id" => $request->permission_id,
                "password" => $password
            ]);

            Mail::to($user->email)->send(new UserMailer($user));

            DB::commit();
            return $user;
        } catch (Throwable $error) {
            DB::rollBack();
            throw new Exception($error);
        }
    }

    public function getAllUsers()
    {
        $usuarios = User::with([
            "permission"
        ])->where("permission_id", "!=", "4")->get();

        return $usuarios;
    }
}
