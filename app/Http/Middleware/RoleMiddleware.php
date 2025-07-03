<?php

// app/Http/Middleware/RoleMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek apakah user sudah login
        if (!Session::has('user_id')) {
            return redirect()->route('login.mahasiswa')->with('error', 'Silakan login terlebih dahulu');
        }

        // Cek apakah role user sesuai dengan yang diizinkan
        $userRole = Session::get('user_role');
        if (!in_array($userRole, $roles)) {
            return redirect()->route('login.mahasiswa')->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        return $next($request);
    }
}