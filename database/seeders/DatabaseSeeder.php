<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Personnel::factory(1)->create();
        \App\Models\User::factory(1)->create();
        \App\Models\Supplier::factory(5)->create();
        \App\Models\OrderDetail::factory(5)->create();
    }
}
