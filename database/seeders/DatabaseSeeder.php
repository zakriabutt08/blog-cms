<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles and permissions first
        $this->call(RolePermissionSeeder::class);

        // Create Admin User
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('Admin');

        // Create Author User
        $author = User::factory()->create([
            'name' => 'Author User',
            'email' => 'author@example.com',
            'password' => bcrypt('password'),
        ]);
        $author->assignRole('Author');

        // Create Reader User
        $reader = User::factory()->create([
            'name' => 'Reader User',
            'email' => 'reader@example.com',
            'password' => bcrypt('password'),
        ]);
        $reader->assignRole('Reader');
    }
}
