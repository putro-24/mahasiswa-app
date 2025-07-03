<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;

class LoginMahasiswaController extends Controller
{
    public function index()
    {
        return view('login.loginmahasiswa');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $credentials = $request->only('username', 'password');
        
        // Coba login dengan username atau email
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']]) ||
            Auth::attempt(['email' => $credentials['username'], 'password' => $credentials['password']])) {
            
            $request->session()->regenerate();
            $user = Auth::user();
            
            // Redirect berdasarkan role
            switch ($user->role) {
                case 'mahasiswa':
                    return redirect()->route('mahasiswa.dashboard')->with('success', 'Selamat datang, ' . $user->name);
                case 'dosen':
                    return redirect()->route('dosen.dashboard')->with('success', 'Selamat datang, ' . $user->name);
                case 'admin':
                    return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, ' . $user->name);
                case 'baak':
                    return redirect()->route('baak.dashboard')->with('success', 'Selamat datang, ' . $user->name);
                default:
                    return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . $user->name);
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login.mahasiswa')->with('success', 'Berhasil logout');
    }
}