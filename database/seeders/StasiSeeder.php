<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stasi;

class StasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stasiList = [
            ['nama' => 'Stasi Santa Maria', 'alamat' => 'Jl. Gereja No. 1'],
            ['nama' => 'Stasi Santo Petrus', 'alamat' => 'Jl. Katedral No. 2'],
            ['nama' => 'Stasi Santo Paulus', 'alamat' => 'Jl. Paroki No. 3'],
            // Tambahkan stasi lain sesuai kebutuhan
        ];

        foreach ($stasiList as $stasi) {
            Stasi::create($stasi);
        }
    }
}