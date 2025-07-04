<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginMahasiswaController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login.mahasiswa');
});

// Login routes
Route::get('/login', [LoginMahasiswaController::class, 'index'])->name('login.mahasiswa');
Route::get('/login/mahasiswa', [LoginMahasiswaController::class, 'index'])->name('login.mahasiswa');
Route::post('/login/authenticate', [LoginMahasiswaController::class, 'authenticate'])->name(name: 'login.authenticate');
Route::post('/logout', [LoginMahasiswaController::class, 'logout'])->name('logout');

// Dashboard routes dengan middleware role
Route::middleware([RoleMiddleware::class . ':mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('dashboard.mahasiswa');
    })->name('mahasiswa.dashboard');
});

Route::middleware([RoleMiddleware::class . ':dosen'])->group(function () {
    Route::get('/dosen/dashboard', function () {
        return view('dashboard.dosen');
    })->name('dosen.dashboard');
});

Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard.admin');
    })->name('admin.dashboard');
    
    // Resource routes untuk admin
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('dosen', DosenController::class);
    Route::resource('pengajuan', PengajuanController::class);
    Route::resource('jurusan', JurusanController::class);
    Route::resource('prodi', ProdiController::class);
});

Route::middleware([RoleMiddleware::class . ':baak'])->group(function () {
    Route::get('/baak/dashboard', function () {
        return view('dashboard.baak');
    })->name('baak.dashboard');
});

// Default dashboard (untuk Laravel auth)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Laravel Breeze Auth routes (optional)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';