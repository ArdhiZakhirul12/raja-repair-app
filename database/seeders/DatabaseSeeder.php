<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\cabang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'tes@gmail.com',
            'password' =>Hash::make('password'),
        ]);
        $user->assignRole('cabang');

        cabang::create([
            'user_id' => $user->id,
            'no_hp' => '081238560837',
            'nama' => 'ardhi',
            'alamat' => 'karangrejo'
        ]);

    }
}
