<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginMahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Login routes
Route::get('/login/mahasiswa', [LoginMahasiswaController::class, 'index'])->name('login.mahasiswa');
Route::post('/login/authenticate', [LoginMahasiswaController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginMahasiswaController::class, 'logout'])->name('logout');

// Dashboard routes untuk setiap role
Route::get('/mahasiswa/dashboard', function () {
    return view('dashboard.mahasiswa');
})->name('mahasiswa.dashboard');

Route::get('/dosen/dashboard', function () {
    return view('dashboard.dosen');
})->name('dosen.dashboard');

Route::get('/admin/dashboard', function () {
    return view('dashboard.admin');
})->name('admin.dashboard');

Route::get('/baak/dashboard', function () {
    return view('dashboard.baak');
})->name('baak.dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('dosen', DosenController::class);
    Route::resource('pengajuan', PengajuanController::class);
});

require __DIR__.'/auth.php';