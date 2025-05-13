<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternshipPosting extends Model
{
    protected $fillable = ['company_id', 'title', 'description', 'quota', 'city', 'application_deadline', 'is_approved'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
