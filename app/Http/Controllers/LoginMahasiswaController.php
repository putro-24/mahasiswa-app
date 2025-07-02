<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\LoginMahasiswa;
use App\Models\User;
use App\Models\Dosen;

class LoginMahasiswaController extends Controller
{
    public function index()
    {
        return view('login.loginmahasiswa');
    }

    public function authenticate(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|in:admin,baak,dosen,mahasiswa'
        ], [
            'username.required' => 'Username harus diisi',
            'password.required' => 'Password harus diisi',
            'role.required' => 'Role harus dipilih'
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
        $role = strtolower($request->input('role'));

        try {
            switch ($role) {
                case 'mahasiswa':
                    return $this->authenticateMahasiswa($username, $password);
                    
                case 'dosen':
                    return $this->authenticateDosen($username, $password);
                    
                case 'admin':
                case 'baak':
                    return $this->authenticateUser($username, $password, $role);
                    
                default:
                    return back()->withInput()->withErrors(['role' => 'Role tidak valid']);
            }
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['login' => 'Terjadi kesalahan sistem. Silakan coba lagi.']);
        }
    }

    private function authenticateMahasiswa($nim, $password)
    {
        // Cari mahasiswa berdasarkan NIM
        $mahasiswa = LoginMahasiswa::where('nim', $nim)->first();
        
        if (!$mahasiswa) {
            return back()->withInput()->withErrors(['username' => 'NIM tidak ditemukan']);
        }

        // Periksa password (gunakan Hash jika password di-hash)
        if (!Hash::check($password, $mahasiswa->password)) {
            return back()->withInput()->withErrors(['password' => 'Password salah']);
        }

        // Periksa status mahasiswa
        if ($mahasiswa->status !== 'active') {
            return back()->withInput()->withErrors(['login' => 'Akun mahasiswa tidak aktif']);
        }

        // Set session untuk mahasiswa
        Session::put('user_id', $mahasiswa->id);
        Session::put('user_role', 'mahasiswa');
        Session::put('user_name', $mahasiswa->nama);
        Session::put('user_nim', $mahasiswa->nim);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Login berhasil sebagai Mahasiswa');
    }

    private function authenticateDosen($nim, $password)
    {
        // Cari dosen berdasarkan NIM
        $dosen = Dosen::where('nim', $nim)->first();
        
        if (!$dosen) {
            return back()->withInput()->withErrors(['username' => 'NIM Dosen tidak ditemukan']);
        }

        // Periksa password
        if (!Hash::check($password, $dosen->password)) {
            return back()->withInput()->withErrors(['password' => 'Password salah']);
        }

        // Periksa status dosen
        if ($dosen->status !== 'active') {
            return back()->withInput()->withErrors(['login' => 'Akun dosen tidak aktif']);
        }

        // Set session untuk dosen
        Session::put('user_id', $dosen->id);
        Session::put('user_role', 'dosen');
        Session::put('user_name', $dosen->nama);
        Session::put('user_nim', $dosen->nim);

        return redirect()->route('dosen.dashboard')->with('success', 'Login berhasil sebagai Dosen');
    }

    private function authenticateUser($email, $password, $role)
    {
        // Cari user berdasarkan email dan role
        $user = User::where('email', $email)->where('role', $role)->first();
        
        if (!$user) {
            return back()->withInput()->withErrors(['username' => 'Email tidak ditemukan untuk role ' . ucfirst($role)]);
        }

        // Periksa password
        if (!Hash::check($password, $user->password)) {
            return back()->withInput()->withErrors(['password' => 'Password salah']);
        }

        // Periksa status user
        if ($user->status !== 'active') {
            return back()->withInput()->withErrors(['login' => 'Akun tidak aktif']);
        }

        // Set session untuk admin/baak
        Session::put('user_id', $user->id);
        Session::put('user_role', $role);
        Session::put('user_name', $user->name);
        Session::put('user_email', $user->email);

        $dashboardRoute = $role === 'admin' ? 'admin.dashboard' : 'baak.dashboard';
        return redirect()->route($dashboardRoute)->with('success', 'Login berhasil sebagai ' . ucfirst($role));
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login.mahasiswa')->with('success', 'Logout berhasil');
    }
}