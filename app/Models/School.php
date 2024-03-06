<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    // Tentukan atribut yang dapat diisi massal
    protected $fillable = ['school_name', 'address', 'phone_number'];
    protected $table = 'schools';

    public function users()
    {
        return $this->hasMany(User::class);
    }
    // Relasi ke Course
    public function courses() {
        return $this->hasMany(Course::class);
    }

    // Relasi ke User (jika menggunakan single table inheritance untuk guru dan siswa)
    // Asumsikan bahwa setiap sekolah memiliki banyak guru dan siswa
    public function teachers() {
        return $this->hasMany(User::class, 'id')->where('role', 'teacher');
    }

    public function students() {
        return $this->hasMany(User::class, 'id')->where('role', 'student');
    }

    public function classes()
    {
        return $this->hasMany(Classes::class, 'school_id', 'id');
    }

    // Contoh scope-query untuk kebutuhan spesifik
    // Misalnya, mendapatkan sekolah dengan jumlah kursus tertentu
    public function scopeWithCoursesCount($query, $count) {
        return $query->has('courses', '=', $count);
    }
}
