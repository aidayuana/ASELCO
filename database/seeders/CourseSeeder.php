<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data kursus awal
        $courses = [
            [
                'title' => 'Python',
                'description' => 'Pengenalan konsep python dasar.',
                'school_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Pemrograman C',
                'description' => 'Memahami dasar-dasar pemrograman dalam bahasa C.',
                'school_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Tambahkan kursus lainnya sesuai kebutuhan
        ];

        // Menambahkan data kursus ke database
        DB::table('courses')->insert($courses);
    }
}
