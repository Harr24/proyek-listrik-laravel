<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Tambahkan ini
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login DAN rolenya cocok dengan yang diizinkan.
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            // Jika tidak cocok, larang akses.
            abort(403, 'AKSES DITOLAK');
        }

        return $next($request);
    }
}