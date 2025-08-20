<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Models\Pessoa;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    public function getEmail()
    {
        return view('auth.passwords.email');
    }

    public function postEmail(Request $request)
    {

        if ($request->email === null) {
            $errors = new MessageBag(['error' => ['Digite o seu email']]);
            return redirect()->back()->withErrors($errors);
        }

        $pessoa = Pessoa::where('email', $request->email)->first();

        if ($pessoa === null) {
            $errors = new MessageBag(['email' => ['O email não existe nos nossos registros!.']]);
            return redirect()->back()->withErrors($errors);
        }

        $token = Str::random(64);

        $result = DB::connection('mysql')->select("select * from password_resets where email = '$request->email'");
        if (count($result) > 0) {
            // elimina o token antigo
            $result =
            DB::connection('mysql')->select("delete from password_resets where email = '$request->email'");
        }

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        $ob = new MailController();
        $res = $ob->resetSenha($pessoa->nome, $pessoa->email, $token);

        // Mail::send(new ResetPasswordMailer($user, $token));

        return redirect('login')->with(['message' => 'Enviamos-lhe um link de redefinição de senha por email.']);
    }
}
