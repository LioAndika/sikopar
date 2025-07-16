<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Stasi;
use Illuminate\Support\Facades\Hash;

class BendaharaStasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bendaharaStasiRole = Role::where('slug', 'bendahara-stasi')->first();
        $stasiUntukBendahara = Stasi::where('nama', 'Stasi Santa Maria')->first(); // Sesuaikan dengan nama stasi yang ada

        if ($bendaharaStasiRole && $stasiUntukBendahara) {
            User::create([
                'name' => 'Bendahara Stasi Maria',
                'email' => 'bendahara.maria@example.com',
                'password' => Hash::make('password'),
                'role_id' => $bendaharaStasiRole->id,
                'stasi_id' => $stasiUntukBendahara->id, // Penting: Hubungkan ke stasi yang ada
            ]);
        } else {
            $this->command->info('Role "bendahara-stasi" or "Stasi Santa Maria" not found. Please ensure RoleSeeder and StasiSeeder are run first.');
        }
    }
}