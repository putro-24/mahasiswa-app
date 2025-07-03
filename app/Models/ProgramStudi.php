<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_prodi',
        'kode_prodi',
        'jurusan_id',
        'id_kaprodi',
        'jenjang',
        'status'
    ];

    // Relationship dengan Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    // Relationship dengan User (Ketua Program Studi)
    public function kaprodi()
    {
        return $this->belongsTo(User::class, 'id_kaprodi');
    }

    // Relationship dengan Mahasiswa
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_prodi');
    }

    // Scope untuk prodi aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}