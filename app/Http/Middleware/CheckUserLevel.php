<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserLevel
{
    public function handle(Request $request, Closure $next, $minLevel = 1)
    {
        if (!Auth::check() || Auth::user()->nivel < $minLevel) {
            abort(403, 'No tienes permisos para acceder a esta sección');
        }

        return $next($request);
    }
}
