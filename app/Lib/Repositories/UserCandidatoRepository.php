<?php

namespace App\Lib\Repositories;

use App\Jobs\UserRegistrationMailerJob;
use Exception, Throwable;
use App\Models\Enterprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lib\Traits\EnterpriseTrait;
use App\Lib\Interfaces\UserInterface;
use App\Lib\Traits\UserTrait;
use App\Mail\CandidaturaMailer;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Candidato;
use App\Models\UserCandidato;
use App\Models\UserMedico;

class UserCandidatoRepository
{
    use UserTrait;

    public function createUser($id, $nome, $bi, $email, $tel, $codigo)
    {

        // $password = $this->generatePassword();

        DB::beginTransaction();
        try {

            $user = User::create([
                "nome" => $nome,
                "num_bi" => $bi,
                "email" => $email,
                "telefone" => $tel,
                "password" => $codigo,
                "permissao_id" => 5
            ]);

            $user_candidato = UserCandidato::create([
                "candidato_id" => $id,
                "user_id" => $user->id
            ]);

            // Mail::to($user->email)->send(new CandidaturaMailer($user, $codigo));

            DB::commit();
            return $user;
        } catch (Throwable $error) {
            DB::rollBack();
            throw new Exception($error);
        }
    }

}
