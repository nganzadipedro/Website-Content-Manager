<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class AdminInstituicaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->permissao_id != 2) {
            return redirect(
                RouteServiceProvider::HOME[
                    Auth::user()->permissao_id
                ]
            );
            # abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
