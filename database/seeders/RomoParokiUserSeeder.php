<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan ini diimpor
use App\Models\Role; // Pastikan ini diimpor
use Illuminate\Support\Facades\Hash; // Pastikan ini diimpor

class RomoParokiUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari role_id untuk 'romo-paroki'
        $romoParokiRole = Role::where('slug', 'romo-paroki')->first();

        // Pastikan role 'romo-paroki' ditemukan
        if ($romoParokiRole) {
            // Cek apakah user dengan email ini sudah ada untuk menghindari duplikasi
            $user = User::firstOrCreate(
                ['email' => 'romo.paroki@example.com'], // Ganti dengan email yang diinginkan
                [
                    'name' => 'Romo Paroki Utama', // Ganti dengan nama yang diinginkan
                    'password' => Hash::make('password'), // Ganti dengan password yang aman
                    'role_id' => $romoParokiRole->id, // Assign role_id dari Romo Paroki
                    // 'stasi_id' => null, // Romo Paroki biasanya tidak terikat stasi spesifik
                ]
            );

            // Jika Anda menggunakan package seperti Spatie Laravel-Permission,
            // Anda mungkin perlu menambahkan baris ini untuk menugaskan peran secara eksplisit:
            // $user->assignRole('romo-paroki'); // Asumsi 'romo-paroki' adalah nama peran yang sesuai di package Anda

            $this->command->info('User Romo Paroki created/updated successfully.');
        } else {
            $this->command->error('Role "romo-paroki" not found. Please run the roles seeder first.');
        }
    }
}