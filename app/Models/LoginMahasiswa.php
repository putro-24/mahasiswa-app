<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';
    protected $fillable = [
    `id`, 
    `nama`, 
    `tempat`, 
    `tanggal_lahir`, 
    `jenis_kelamin`, 
    `nim`, 
    `jurusan`, 
    `prodi`, 
    `reguler`, 
    `poin`, 
    `email`, 
    `hp`, 
    `tahun_masuk`, 
    `no_ijasah`, 
    `tanggal_kelulusan`, 
    `gelar`, 
    `SK-BAN-PT/AKREDITASI`, 
    `SK_PENDIRIAN_Prodi`, 
    `username`, 
    `password`, 
    `level`, 
    `status`,
    `terdaftar`,
    ];

}
