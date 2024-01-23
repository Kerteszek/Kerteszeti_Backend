<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->permission == 1) {
            //admin
            return $next($request);
        }
        return redirect('/')->with('error', 'You have not admin access');
        //a home még nincs kész, itt kell megadni a Terelést 
    }
}
