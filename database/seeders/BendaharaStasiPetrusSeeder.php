<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Stasi;
use Illuminate\Support\Facades\Hash;

class BendaharaStasiPetrusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bendaharaStasiRole = Role::where('slug', 'bendahara-stasi')->first();
        $stasiUntukBendahara = Stasi::where('nama', 'Stasi Santo Petrus')->first(); // Menggunakan Stasi Santo Petrus

        if ($bendaharaStasiRole && $stasiUntukBendahara) {
            User::create([
                'name' => 'Bendahara Stasi Petrus',
                'email' => 'bendahara.petrus@example.com', // Email unik
                'password' => Hash::make('password'),
                'role_id' => $bendaharaStasiRole->id,
                'stasi_id' => $stasiUntukBendahara->id,
            ]);
            $this->command->info('User Bendahara Stasi Petrus created.');
        } else {
            $this->command->error('Role "bendahara-stasi" or "Stasi Santo Petrus" not found.');
        }
    }
}