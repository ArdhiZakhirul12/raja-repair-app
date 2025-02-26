<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::create([
            'name' => 'Test Super Admin',
            'email' => 'superAdminTest@gmail.com',
            'password' =>Hash::make('password'),
        ]);
        $user->assignRole('super-admin');
        //
    }
}
