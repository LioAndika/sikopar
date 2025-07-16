<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class BendaharaParokiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bendaharaParokiRole = Role::where('slug', 'bendahara-paroki')->first();

        if ($bendaharaParokiRole) {
            User::create([
                'name' => 'Bendahara Paroki Pusat',
                'email' => 'bendahara.paroki@example.com', // Email untuk login Bendahara Paroki
                'password' => Hash::make('password'),  // Password: 'password'
                'role_id' => $bendaharaParokiRole->id,
                'stasi_id' => null, // Bendahara Paroki tidak terikat pada satu stasi
            ]);
            $this->command->info('User Bendahara Paroki Pusat created.');
        } else {
            $this->command->error('Role "bendahara-paroki" not found. Please ensure RoleSeeder is run first.');
        }
    }
}