<?php

namespace Kamus\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{

    public function handle($request, Closure $next)
    {

        if (Auth::check() && Auth::user()->isAdmin() === 'admin') {
            return $next($request);
        }

        return redirect('/');

    }

}
