<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login dengan session custom
        if (!Session::has('authenticated') || !Session::get('authenticated')) {
            return redirect()->route('login.mahasiswa')
                ->withErrors(['login' => 'Silakan login terlebih dahulu']);
        }

        // Cek apakah session masih valid
        if (!Session::has('user_role') || !Session::has('user_id')) {
            Session::flush();
            return redirect()->route('login.mahasiswa')
                ->withErrors(['login' => 'Session tidak valid, silakan login kembali']);
        }

        return $next($request);
    }
}