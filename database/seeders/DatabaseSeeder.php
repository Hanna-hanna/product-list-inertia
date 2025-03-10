<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProductSeeder::class,
        ]);

        // Admin
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'annlisandias@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
