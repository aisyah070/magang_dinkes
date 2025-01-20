<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('admin')->check()){
            // abort(403);
            return redirect()->intended('/dashboard');
        }
        if(Auth::guard('web')->check()){
            // abort(403);
            return redirect()->intended('/beranda');
        }

        return $next($request);
    }
}
