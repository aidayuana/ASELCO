<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar sekolah
        $schools = [
            [
                'school_name' => 'SMK TELKOM MALANG',
                'address' => 'Jl. Danau Ranau, Sawojajar, Kec. Kedungkandang, Kota Malang',
                // Tambahkan kolom lain sesuai dengan struktur tabel schools Anda
            ],
            [
                'school_name' => 'SMK NEGERI 2 SINGOSARI',
                'address' => 'Jl. Perusahaan No.20, Tanjungtirto, Singosari, Jajar, Tanjungtirto, Kec. Singosari, Kabupaten Malang',
                // Tambahkan kolom lain sesuai dengan struktur tabel schools Anda
            ],
            // Tambahkan lebih banyak sekolah sesuai kebutuhan
        ];

        // Memasukkan data sekolah ke database
        foreach ($schools as $school) {
            DB::table('schools')->insert([
                'school_name' => $school['school_name'],
                'address' => $school['address'],
                // Pastikan untuk menyesuaikan ini dengan kolom yang ada pada tabel schools Anda
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
