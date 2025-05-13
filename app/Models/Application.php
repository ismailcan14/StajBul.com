<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'student_id',
        'internship_posting_id',
        'cover_letter',
        'status',
        'cv_path', // ✅ Buraya ekledik
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function internshipPosting()
    {
        return $this->belongsTo(InternshipPosting::class);
    }
}

