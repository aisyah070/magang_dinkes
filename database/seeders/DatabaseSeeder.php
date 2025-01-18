<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Admin::create([
            'name' => 'Aisyah',
            'email' => 'aisyah@gmail.com',
            'password' => bcrypt('12345'),
        ]);

        User::create([
            'name' => 'sein',
            'email' => 'sein@gmail.com',
            'admin_id' => 1,
            'password' => bcrypt('12345'),
        ]);
    }
}
