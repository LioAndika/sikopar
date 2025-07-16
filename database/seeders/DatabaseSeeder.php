<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            StasiSeeder::class, // Tambahkan ini
            SuperAdminSeeder::class,
            BendaharaStasiSeeder::class,
            KetuaStasiSeeder::class,
            BendaharaStasiPetrusSeeder::class, 
            KetuaStasiPetrusSeeder::class, 
            BendaharaParokiSeeder::class,
            RomoParokiUserSeeder::class,
            SekretarisParokiUserSeeder::class,   
            // Anda mungkin ingin membuat user Bendahara Stasi di sini juga untuk testing
            // UserStasiSeeder::class,
        ]);
    }
}