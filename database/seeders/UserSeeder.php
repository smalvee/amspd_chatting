<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Super Admin
        User::create([
            'type' => 'Super Admin',
            'status' => 'Active',
            'name' => 'Super Admin',
            'email' => 'superadmin@ampsd.com',
            'password' => bcrypt('12345678'),
        ]);

        // Admin
        User::create([
            'type' => 'Admin',
            'status' => 'Active',
            'name' => 'Admin',
            'email' => 'admin@ampsd.com',
            'password' => bcrypt('12345678'),
        ]);

        // User
        User::create([
            'type' => 'User',
            'status' => 'Active',
            'name' => 'User',
            'email' => 'user@ampsd.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
