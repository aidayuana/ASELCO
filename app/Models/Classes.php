<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes'; // The name of the table in the database
    protected $fillable = ['class_name', 'school_id']; // Ensure these are the columns you want to be mass-assignable
    // protected $primaryKey = 'id'; // Only necessary if using a non-standard primary key
    // public $timestamps = false; // Uncomment if your table does not use the timestamps

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'class_id', 'id'); // Make sure the foreign key is correct
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'class_course', 'class_id', 'course_id');
    }
}
