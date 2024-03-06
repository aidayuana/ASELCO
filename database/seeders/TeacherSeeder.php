<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Pastikan role 'teacher' sudah ada
        $teacherRole = Role::where('name', 'teacher')->firstOrFail();

        // Daftar guru
        $teachers = [
            ['name' => 'Guru 1', 'email' => 'guru1@example.com', 'password' => bcrypt('password123')],
            ['name' => 'Guru 2', 'email' => 'guru2@example.com', 'password' => bcrypt('password123')],
            // Tambahkan lebih banyak guru sesuai kebutuhan
        ];

        foreach ($teachers as $teacher) {
            // Membuat user baru untuk setiap guru
            $user = User::create([
                'name' => $teacher['name'],
                'email' => $teacher['email'],
                'password' => $teacher['password'],
            ]);

            // Menetapkan role 'teacher' ke user
            $user->assignRole($teacherRole);
        }
    }
}
