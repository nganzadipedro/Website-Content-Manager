<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ActividadesistemaController;
use App\Models\User;
use App\Models\Pessoa;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Lib\Traits\GeralTrait;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    use GeralTrait;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $for = [
        1 => 'system.admin.dashboard',
        2 => 'system.gestor.dashboard',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    protected function redirectTo()
    {
        return $this->redirectTo = route(
            $this->for[auth()->user()->permissao_id]
        );
    }

    public function login(Request $request)
    {

        $pessoa = Pessoa::where('email', $request->email)->first();
        //dd($pessoa);
        if ($pessoa) {
 
            $user = User::where([
                'pessoa_id' => $pessoa->id,
                'estado' => 'ativo'
            ])->first();

            if ($user) {
                if (Hash::check($request->password, $user->password)) {

                    Auth::login($user);
                    // regista actividade do sistema
                    ActividadesistemaController::inserir($user->id, 'Acessou o sistema');
                    return redirect()->route(
                        $this->for[auth()->user()->permissao_id]
                    );

                } else {
                    $errors = new MessageBag(['error' => ['Email and/or password invalid.']]);
                    return redirect()->back()->withErrors($errors);
                }
            } else {
                $errors = new MessageBag(['error' => ['Email and/or password invalid.']]);
                return redirect()->back()->withErrors($errors);
            }
        } else {
            $errors = new MessageBag(['error' => ['Email and/or password invalid.']]);
            return redirect()->back()->withErrors($errors);
        }
    }

}
