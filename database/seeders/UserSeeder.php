<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Webmaster',
            'lastname' => 'Admin',
            'email' => 'webmaster@rinconjabonero.com',
            'email_verified_at' => now(),
            'password' => Hash::make('RinconJabonero2024'),
            'role_id' => Role::ADMIN
        ]);

        User::create([
            'name' => 'User',
            'lastname' => 'Normal',
            'email' => 'user@rinconjabonero.com',
            'email_verified_at' => now(),
            'password' => Hash::make('RinconJabonero2024'),
            'role_id' => Role::USER
        ]);

        User::create([
            'name' => 'Margot',
            'lastname' => 'Robbie',
            'email' => 'margot.robbie@rinconjabonero.com',
            'email_verified_at' => now(),
            'password' => Hash::make('RinconJabonero2024'),
            'role_id' => Role::USER
        ]);


    }
}
