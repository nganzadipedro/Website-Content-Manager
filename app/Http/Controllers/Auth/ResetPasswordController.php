<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public function getPassword($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {

        $request->validate([
            'token' => 'required',
            'password' => 'required|string',
            'password_confirmation' => 'required',
        ]);


        if(strlen($request->password) < 8){
            $errors = new MessageBag(['error' => ['A senha deve ter no mínimo 8 caracteres']]);
            return redirect()->back()->withErrors($errors);
        } 


        $updatePassword = DB::table('password_resets')
            ->where(['token' => $request->token])
            ->first();


        if ($updatePassword == null) {
            $errors = new MessageBag(['error' => ['Token de validação inválido. Repita o processo de recuperação de senha']]);
            return redirect()->back()->withErrors($errors);
            // return back()->withInput()->with('error', 'Invalid token!');
        }

        if ($request->password != $request->password_confirmation) {
            $errors = new MessageBag(['error' => ['A senha não foi confirmada']]);
            return redirect()->back()->withErrors($errors);
            // return back()->withInput()->with('error', 'Invalid token!');
        }

        $pessoa = Pessoa::where('email', $updatePassword->email)->first();
        if ($pessoa === null) {
            $errors = new MessageBag(['error' => ['Token de validação inválido. Repita o processo de recuperação de senha']]);
        } else {
            $user = User::where('pessoa_id', $pessoa->id)->first();
            $user->password = md5($request->password);
            $user->save();

            DB::table('password_resets')->where(['email' => $updatePassword->email])->delete();
            return redirect('login')->with(['message' => 'A sua senha foi redefinida com sucesso!']);
        }
    }
}
