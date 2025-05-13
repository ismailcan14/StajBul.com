<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Internship;


class HistoryController extends Controller
{
    public function index()
    {
$student = Auth::user()->student;
        $internships = Internship::with('company')
            ->where('student_id', $student->id)
            ->latest()
            ->get();

        return view('student.history.index', compact('internships'));    }
}
