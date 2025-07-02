<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginMahasiswa;

class LoginMahasiswaController extends Controller
{
    public function index()
    {
        // $mahasiswas = LoginMahasiswa::all();
        return view('login.loginmahasiswa');
    }
}