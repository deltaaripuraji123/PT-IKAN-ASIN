<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat user admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);
        
        // Membuat user customer
        User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@example.com',
            'role' => 'customer',
        ]);
        
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}