<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class SekretarisParokiUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sekretarisParokiRole = Role::where('slug', 'sekretaris-paroki')->first();

        if ($sekretarisParokiRole) {
            User::firstOrCreate(
                ['email' => 'sekretaris.paroki@example.com'], // Ganti dengan email yang diinginkan
                [
                    'name' => 'Sekretaris Paroki', // Ganti dengan nama yang diinginkan
                    'password' => Hash::make('password'), // Ganti dengan password yang aman
                    'role_id' => $sekretarisParokiRole->id,
                ]
            );
            $this->command->info('User Sekretaris Paroki created/updated successfully.');
        } else {
            $this->command->error('Role "sekretaris-paroki" not found. Please run the roles seeder first.');
        }
    }
}