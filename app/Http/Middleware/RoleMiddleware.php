<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)  // ← ubah ke ...$roles (array)
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk halaman ini.');
        }

        $userRole = Auth::user()->role;
        
        // Cek apakah role user termasuk dalam roles yang diizinkan
        if (in_array($userRole, $roles)) {  // ← pakai in_array
            return $next($request);
        }

        // Abort jika tidak memiliki izin
        abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk halaman ini.');
    }
}