<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::all();
        return view('pengajuan.index', compact('pengajuans'));
    }
}