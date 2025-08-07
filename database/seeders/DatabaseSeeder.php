<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SemesterSeeder::class,
            RoleSeeder::class,
        ]);

        $adminRole = Role::where('name', 'Admin')->first();
        $guruRole = Role::where('name', 'Guru')->first();
        $siswaRole = Role::where('name', 'Siswa')->first();

        // Cek dulu sebelum membuat user Admin
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role_id' => $adminRole->id,
            ]);
        }

        // Cek dulu sebelum membuat user Guru
        if (!User::where('email', 'guru@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Guru Contoh',
                'email' => 'guru@example.com',
                'password' => Hash::make('password123'),
                'role_id' => $guruRole->id,
            ]);
        }

        // Cek dulu sebelum membuat user Siswa
        if (!User::where('nisn', '1234567890')->exists()) {
            User::factory()->create([
                'name' => 'Siswa Contoh',
                'nisn' => '1234567890',
                'email' => null,
                'password' => Hash::make('password123'),
                'role_id' => $siswaRole->id,
            ]);
        }
    }
}
