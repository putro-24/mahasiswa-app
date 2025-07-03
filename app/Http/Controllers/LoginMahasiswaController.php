<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\LoginMahasiswa;
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
            'role' => 'required|in:admin,baak,dosen,mahasiswa'
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
            'role.required' => 'Role wajib dipilih'
        ]);

        $credentials = $request->only('username', 'password');
        $role = $request->role;

        // Coba login dengan Laravel Auth terlebih dahulu (untuk admin dan baak)
        if (in_array($role, ['admin', 'baak'])) {
            if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']]) ||
                Auth::attempt(['email' => $credentials['username'], 'password' => $credentials['password']])) {
                
                $user = Auth::user();
                
                // Cek apakah role sesuai
                if ($user->role === $role) {
                    $request->session()->regenerate();
                    
                    // Set session data
                    Session::put('user_id', $user->id);
                    Session::put('user_name', $user->name);
                    Session::put('user_role', $user->role);
                    Session::put('user_email', $user->email);
                    
                    return $this->redirectByRole($user->role, $user->name);
                } else {
                    Auth::logout();
                    return back()->withErrors([
                        'role' => 'Role yang dipilih tidak sesuai dengan akun Anda.',
                    ])->withInput($request->only('username'));
                }
            }
        }

        // Login untuk mahasiswa
        if ($role === 'mahasiswa') {
            $mahasiswa = LoginMahasiswa::where('username', $credentials['username'])
                ->orWhere('email', $credentials['username'])
                ->first();

            if ($mahasiswa && password_verify($credentials['password'], $mahasiswa->password)) {
                $request->session()->regenerate();
                
                // Set session data
                Session::put('user_id', $mahasiswa->id);
                Session::put('user_name', $mahasiswa->nama);
                Session::put('user_role', 'mahasiswa');
                Session::put('user_email', $mahasiswa->email);
                Session::put('user_nim', $mahasiswa->nim);
                
                return redirect()->route('mahasiswa.dashboard')
                    ->with('success', 'Selamat datang, ' . $mahasiswa->nama);
            }
        }

        // Login untuk dosen
        if ($role === 'dosen') {
            $dosen = Dosen::where('username', $credentials['username'])
                ->orWhere('email', $credentials['username'])
                ->first();

            if ($dosen && password_verify($credentials['password'], $dosen->password)) {
                $request->session()->regenerate();
                
                // Set session data
                Session::put('user_id', $dosen->id);
                Session::put('user_name', $dosen->nama);
                Session::put('user_role', 'dosen');
                Session::put('user_email', $dosen->email);
                Session::put('user_nip', $dosen->nip ?? '');
                
                return redirect()->route('dosen.dashboard')
                    ->with('success', 'Selamat datang, ' . $dosen->nama);
            }
        }

        return back()->withErrors([
            'username' => 'Username, password, atau role tidak valid.',
        ])->withInput($request->only('username'));
    }

    private function redirectByRole($role, $name)
    {
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Selamat datang, ' . $name);
            case 'baak':
                return redirect()->route('baak.dashboard')
                    ->with('success', 'Selamat datang, ' . $name);
            case 'dosen':
                return redirect()->route('dosen.dashboard')
                    ->with('success', 'Selamat datang, ' . $name);
            case 'mahasiswa':
                return redirect()->route('mahasiswa.dashboard')
                    ->with('success', 'Selamat datang, ' . $name);
            default:
                return redirect()->route('dashboard')
                    ->with('success', 'Selamat datang, ' . $name);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login.mahasiswa')
            ->with('success', 'Berhasil logout');
    }
}