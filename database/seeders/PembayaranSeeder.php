<?php

namespace Database\Seeders;

use App\Models\metodePembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        metodePembayaran::create(['metode' => 'belum bayar']);
    }
}
