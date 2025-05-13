<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\InternshipPosting;

class InternshipController extends Controller
{
    public function index()
    {
        $postings = InternshipPosting::where('is_approved', true)->latest()->get();
        return view('student.internships.index', compact('postings'));
    }
    public function show($id)
{
    $posting =InternshipPosting::findOrFail($id);
    return view('student.internships.show', compact('posting'));
}


}