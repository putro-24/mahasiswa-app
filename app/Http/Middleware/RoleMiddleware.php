<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek apakah user sudah login (Laravel Auth atau Session)
        if (!Auth::check() && !Session::has('user_id')) {
            return redirect()->route('login.mahasiswa')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        // Ambil role user
        $userRole = null;
        
        if (Auth::check()) {
            // Jika menggunakan Laravel Auth
            $userRole = Auth::user()->role;
        } elseif (Session::has('user_role')) {
            // Jika menggunakan Session
            $userRole = Session::get('user_role');
        }

        // Cek apakah role user sesuai dengan yang diizinkan
        if (!$userRole || !in_array($userRole, $roles)) {
            return redirect()->route('login.mahasiswa')
                ->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        return $next($request);
    }
}