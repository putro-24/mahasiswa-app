<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class LoginMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';
    
    protected $fillable = [
        'id', 
        'nama', 
        'tempat', 
        'tanggal_lahir', 
        'jenis_kelamin', 
        'nim', 
        'jurusan', 
        'prodi', 
        'reguler', 
        'poin', 
        'email', 
        'hp', 
        'tahun_masuk', 
        'no_ijasah', 
        'tanggal_kelulusan', 
        'gelar', 
        'SK_BAN_PT_AKREDITASI', // Fixed nama kolom
        'SK_PENDIRIAN_Prodi', 
        'username', 
        'password', 
        'level', 
        'status',
        'terdaftar',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_kelulusan' => 'date',
        'tahun_masuk' => 'integer',
        'poin' => 'integer',
    ];

    // Automatically hash password when setting
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    // Scope untuk mahasiswa aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}