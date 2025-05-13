<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['user_id', 'company_name', 'tax_number', 'authorized_person', 'address', 'logo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function internshipPostings()
    {
        return $this->hasMany(InternshipPosting::class);
    }

    public function internships()
    {
        return $this->hasMany(Internship::class);
    }
}

