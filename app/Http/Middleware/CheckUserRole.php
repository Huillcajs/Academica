<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/'); 
        }

        $user = Auth::user();

        if (!in_array($user->role, $roles)) {
            return redirect('/dashboard')->with('error', 'Acceso denegado. No tienes el rol necesario.');
        }

        return $next($request);
    }
}