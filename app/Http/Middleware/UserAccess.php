<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('token') || session('role') === null) {
            return redirect()->route('auth.login.view');
        } else if (session('role') !== 1) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
