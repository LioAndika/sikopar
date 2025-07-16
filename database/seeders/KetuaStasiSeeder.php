<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Stasi;
use Illuminate\Support\Facades\Hash;

class KetuaStasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan role 'ketua-stasi' sudah ada
        $ketuaStasiRole = Role::where('slug', 'ketua-stasi')->first();

        // Ambil Stasi yang akan dipimpin oleh Ketua Stasi ini
        // PASTIKAN NAMA STASI INI SAMA DENGAN STASI YANG DIINPUT OLEH BENDAHARA STASI
        $stasiUntukKetua = Stasi::where('nama', 'Stasi Santa Maria')->first(); // Sesuaikan jika nama stasi Anda berbeda

        if ($ketuaStasiRole && $stasiUntukKetua) {
            User::create([
                'name' => 'Ketua Stasi Maria',
                'email' => 'ketua.maria@example.com', // Email untuk login Ketua Stasi
                'password' => Hash::make('password'),  // Password: 'password'
                'role_id' => $ketuaStasiRole->id,
                'stasi_id' => $stasiUntukKetua->id, // Penting: Hubungkan ke stasi yang sama dengan bendahara
            ]);
            $this->command->info('User Ketua Stasi Maria created.');
        } else {
            $this->command->error('Role "ketua-stasi" or "Stasi Santa Maria" not found. Please ensure RoleSeeder and StasiSeeder are run first.');
        }
    }
}