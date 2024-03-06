<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // Nama kursus
        'description', // Deskripsi kursus
        'school_id', // FK ke tabel schools
        // Tambahkan atribut lain yang diperlukan
    ];

    public function school() {
        return $this->belongsTo(School::class);
    }

}
