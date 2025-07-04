<?php

// database/seeders/AdminSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus user admin yang ada jika ada
        User::where('email', 'admin@admin.com')->delete();
        User::where('username', 'admin')->delete();

        // Buat user admin dengan password yang benar
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => Hash::make('password'), // Pastikan menggunakan Hash::make
            'role' => 'admin',
            'status' => 'active',
        ]);

        // Hapus user BAAK yang ada jika ada
        User::where('email', 'baak@baak.com')->delete();
        User::where('username', 'baak')->delete();

        // Buat user BAAK dengan password yang benar
        User::create([
            'name' => 'BAAK User',
            'email' => 'baak@baak.com',
            'username' => 'baak',
            'password' => Hash::make('password'), // Pastikan menggunakan Hash::make
            'role' => 'baak',
            'status' => 'active',
        ]);

        echo "Admin dan BAAK users berhasil dibuat!\n";
        echo "Login Admin: username=admin, password=password\n";
        echo "Login BAAK: username=baak, password=password\n";
    }
}