<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosens';
    
    protected $fillable = [
        'nama',
        'nim', // NIM/NIDN dosen
        'email',
        'hp',
        'jurusan',
        'prodi',
        'jabatan',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Automatically hash password when setting
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    // Scope untuk dosen aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}