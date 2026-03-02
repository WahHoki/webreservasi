<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * $roles (array) berisi daftar role yang diizinkan lewat.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user yang login memiliki role yang sesuai dengan yang diizinkan
        if (!in_array($request->user()->role, $roles)) {
            // Jika tidak sesuai, tolak akses dan tampilkan error 403 Forbidden
            abort(403, 'Maaf, Anda tidak memiliki hak akses untuk halaman ini.');
        }

        return $next($request);
    }
}