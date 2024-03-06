<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    // Atribut yang dapat diisi
    protected $fillable = ['name', 'email', 'school_id'];

    // Relasi ke School
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // Relasi ke Course
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    // Anda mungkin perlu menambahkan fungsi tambahan sesuai dengan kebutuhan sistem
}
