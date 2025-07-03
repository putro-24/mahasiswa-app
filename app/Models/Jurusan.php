<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_jurusan',
        'kode_jurusan', 
        'id_kajur',
        'status'
    ];

    // Relationship dengan User (Ketua Jurusan)
    public function kajur()
    {
        return $this->belongsTo(User::class, 'id_kajur');
    }

    // Relationship dengan Program Studi
    public function programStudi()
    {
        return $this->hasMany(ProgramStudi::class, 'jurusan_id');
    }

    // Scope untuk jurusan aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}