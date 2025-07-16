<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Stasi;
use Illuminate\Support\Facades\Hash;

class KetuaStasiPetrusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ketuaStasiRole = Role::where('slug', 'ketua-stasi')->first();
        $stasiUntukKetua = Stasi::where('nama', 'Stasi Santo Petrus')->first(); // Menggunakan Stasi Santo Petrus

        if ($ketuaStasiRole && $stasiUntukKetua) {
            User::create([
                'name' => 'Ketua Stasi Petrus',
                'email' => 'ketua.petrus@example.com', // Email unik
                'password' => Hash::make('password'),
                'role_id' => $ketuaStasiRole->id,
                'stasi_id' => $stasiUntukKetua->id,
            ]);
            $this->command->info('User Ketua Stasi Petrus created.');
        } else {
            $this->command->error('Role "ketua-stasi" or "Stasi Santo Petrus" not found.');
        }
    }
}