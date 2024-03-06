<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        // Ensure to run php artisan db:seed --class=RoleSeeder first or include it in DatabaseSeeder

        // Creating users for each role
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password') // Consider using a more secure way to handle passwords
        ]);
        $superAdmin->assignRole('superadmin');

        $schoolAdmin = User::create([
            'name' => 'School Admin',
            'email' => 'schooladmin@gmail.com',
            'password' => bcrypt('password')
        ]);
        $schoolAdmin->assignRole('schooladmin');

        $teacher = User::create([
            'name' => 'Teacher',
            'email' => 'teacher@gmail.com',
            'password' => bcrypt('password')
        ]);
        $teacher->assignRole('teacher');

        $student = User::create([
            'name' => 'Student',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password')
        ]);
        $student->assignRole('student');
    }
}
