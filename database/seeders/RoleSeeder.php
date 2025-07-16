<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Super Admin', 'slug' => 'super-admin', 'description' => 'Administrator dengan hak akses penuh.'],
            ['name' => 'Bendahara Stasi', 'slug' => 'bendahara-stasi', 'description' => 'Mengelola kolekte di tingkat stasi.'],
            ['name' => 'Ketua Stasi', 'slug' => 'ketua-stasi', 'description' => 'Memvalidasi laporan kolekte stasi.'],
            ['name' => 'Bendahara Paroki', 'slug' => 'bendahara-paroki', 'description' => 'Memvalidasi dan mengelola kolekte tingkat paroki.'],
            ['name' => 'Sekretaris Paroki', 'slug' => 'sekretaris-paroki', 'description' => 'Mengelola pengumuman dan cetak laporan.'],
            ['name' => 'Romo Paroki', 'slug' => 'romo-paroki', 'description' => 'Validasi akhir dan akses laporan.'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}