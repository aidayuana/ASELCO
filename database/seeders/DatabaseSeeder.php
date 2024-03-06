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
        $this->call([
            RoleSeeder::class,
            UserTableSeeder::class, // This should match the actual class name and file name
            SchoolSeeder::class,
            ClassesSeeder::class,
            RolesAndPermissionsSeeder::class
        ]);
    }
}
