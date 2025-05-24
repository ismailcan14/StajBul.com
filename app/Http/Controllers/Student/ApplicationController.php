<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Internship;

class ApplicationController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;

        $applications = Application::with('internshipPosting')
            ->where('student_id', $student->id)
            ->latest()
            ->get();

        return view('student.applications.index', compact('applications'));
    }

    public function store(Request $request, $id)
    {
        
        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|string',
        ]);
        
        $student = Auth::user()->student;

        // Devam eden bir stajı varsa başvuru engelle
        if ($student->internship && is_null($student->internship->end_date)) {
            return redirect()->back()->with('error', 'Devam eden stajınız var. Yeni başvuru yapamazsınız.');
        }

        $cvPath = $request->file('cv')->store('cv_uploads', 'public');
       
        Application::create([
            'student_id' => $student->id,
            'internship_posting_id' => $id,
            'cv_path' => $cvPath,
            'cover_letter' => $request->cover_letter,
            'status' => 'pending',
        ]);

        return redirect()->route('student.applications.index')->with('success', 'Başvurunuz alınmıştır.');
    }

    public function destroy($id)
    {
        $application = Application::findOrFail($id);

        if ($application->student_id !== Auth::user()->student->id) {
            abort(403, 'Bu başvuru size ait değil.');
        }

        $application->delete();

        return redirect()->route('student.applications.index')->with('success', 'Başvuru iptal edildi.');
    }

    // ✅ Öğrenci stajı başlatıyor (kabul edilen başvuruyu onaylayarak)
    public function confirmAccepted($id)
{
    $application = Application::findOrFail($id);

    if ($application->student_id !== auth()->user()->student->id || $application->status !== 'accepted') {
        return redirect()->back()->with('error', 'Bu başvuruyu onaylayamazsınız.');
    }

    // Aktif staj kontrolü
    $activeInternship = auth()->user()->student->internships()->whereNull('end_date')->first();

    if ($activeInternship) {
        return redirect()->back()->with('error', 'Devam eden bir stajınız var. Yeni bir staj başlatamazsınız.');
    }

    Internship::create([
        'student_id' => $application->student_id,
        'company_id' => $application->internshipPosting->company_id,
        'start_date' => now(),
        'report_file_url' => null,
    ]);

    return redirect()->route('student.internship.active')->with('success', 'Stajınız başlatıldı.');
}

}
