<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classes;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat data kelas untuk setiap sekolah
        $schools = \App\Models\School::all();

        foreach ($schools as $school) {
            Classes::create([
                'school_id' => $school->id,
                'name' => 'Kelas A', // Sesuaikan dengan nama kelas yang diinginkan
            ]);

            Classes::create([
                'school_id' => $school->id,
                'name' => 'Kelas B', // Sesuaikan dengan nama kelas yang diinginkan
            ]);

            // Tambahkan kelas lain sesuai kebutuhan
        }
    }
}
