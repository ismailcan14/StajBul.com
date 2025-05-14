<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Internship;
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
    $posting = InternshipPosting::findOrFail($id);
    return view('student.internships.show', compact('posting'));
}
public function active()
{
    $studentId = auth()->user()->student->id;

    $internship =Internship::with('company')
        ->where('student_id', $studentId)
        ->whereNull('end_date') // aktif olan staj
        ->first();

    return view('student.internships.active', compact('internship'));
}
public function confirmAccepted($id)
{
    $application = Application::findOrFail($id);

    // Sadece kendi başvurusu ve kabul edilen olmalı
    if ($application->student_id !== auth()->user()->student->id || $application->status !== 'accepted') {
        return redirect()->back()->with('error', 'Bu başvuruyu onaylayamazsınız.');
    }

    // Daha önce aktif stajı varsa izin verme
    $hasActiveInternship = auth()->user()->student->internships()
        ->whereNull('end_date')
        ->exists();

    if ($hasActiveInternship) {
        return redirect()->back()->with('error', 'Devam eden bir stajınız var.');
    }

    // Staj kaydını oluştur
    Internship::create([
        'student_id' => $application->student_id,
        'company_id' => $application->internshipPosting->company_id,
        'start_date' => now(), // veya istenirse input olarak alınabilir
        'report_file_url' => null,
    ]);

    return redirect()->route('student.internships.index')->with('success', 'Stajınız başlatıldı.');
}
}
