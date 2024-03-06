<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'school_id',
        'class_id', // Pastikan ini sesuai dengan input form registrasi
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // Hapus 'password' => 'hashed',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function class()
    {
        // Pastikan nama model sesuai dan tidak menggunakan reserved keyword.
        return $this->belongsTo(Classes::class, 'class_id'); // Ganti 'Classes' dengan nama model yang benar
    }
}
