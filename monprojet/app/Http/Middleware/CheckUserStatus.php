<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->status == 'blocked') {
            return redirect()->route('home')->with('error', 'Votre compte est bloqué !');
        }

        return $next($request);
    }
}
