<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|array  $roles
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek apakah sesi memiliki salah satu dari peran yang diizinkan
        $authorized = false;
        foreach ($roles as $role) {
            if (session('role') === $role) {
                $authorized = true;
                break;
            }
        }

        if (!$authorized) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
