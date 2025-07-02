<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // tambahkan field role
        'status', // tambahkan field status
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Scope untuk user aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope berdasarkan role
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }
}
