<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Personnel;
use App\Models\ExpiredItem;
use App\Models\OrderDetail;
use App\Models\SalesDetail;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('personnels')->insert([
            [
                'fname' => 'Aljon',
                'mname' => 'Centes',
                'lname' => 'Lerios',
            ],
            [
                'fname' => 'John',
                'mname' => 'Doe',
                'lname' => 'Smith',
            ]
        ]);

        DB::table('users')->insert([
            [
                'empid' => 1,
                'username' => 'manager',
                'email' => 'aljonclerios@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'manager',
                'remember_token' => Str::random(10),
            ],
            [
                'empid' => 2,
                'username' => 'cashier',
                'email' => 'cashier@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'cashier',
                'remember_token' => Str::random(10),
            ]
        ]);

        Supplier::factory(5)->create();
        OrderDetail::factory(5)->create();
        ExpiredItem::factory(5)->create();
        SalesDetail::factory(5)->create();
    }
}
