<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    protected $fillable = [
        'student_id',
        'company_id',
        'start_date',
        'end_date',
        'report_file_url'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function internshipPosting()
    {
        return $this->belongsTo(InternshipPosting::class);
    }
}
