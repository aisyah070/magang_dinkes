<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Hash; // Import Hash untuk hashing password

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'    => 'Siti Annisa Marzia',
            'email'   => 'Sitiannisamarzia27@gmail.com',
            'password' => Hash::make('Password'), // Gunakan Hash::make untuk hashing password
        ]);
    }
}
