<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
            'phone' => '+81 90-1234-5678',
            'company' => 'Global Export Car',
            'email_verified_at' => now(),
        ]);

        // Create sample client
        User::create([
            'name' => 'John Doe',
            'email' => 'client@example.com',
            'password' => Hash::make('password'),
            'role' => 'client',
            'is_active' => true,
            'phone' => '+1 234-567-8901',
            'company' => 'Auto Import USA',
            'email_verified_at' => now(),
        ]);

        // Create sample client 2
        User::create([
            'name' => '山田 太郎',
            'email' => 'yamada@example.com',
            'password' => Hash::make('password'),
            'role' => 'client',
            'is_active' => true,
            'phone' => '+81 90-9876-5432',
            'company' => 'Japan Auto Trade',
            'email_verified_at' => now(),
        ]);
    }
}