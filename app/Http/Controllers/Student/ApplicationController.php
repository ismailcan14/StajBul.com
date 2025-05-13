<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
{
    $student = Auth::user()->student;

    $applications = \App\Models\Application::with('internshipPosting')
        ->where('student_id', $student->id)
        ->latest()
        ->get();

    return view('student.applications.index', compact('applications'));
}


    public function store(Request $request, $id)
    {
        // Yalnızca CV dosyasının doğrulamasını yapıyoruz
        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',  // Maksimum 2MB
        ]);
    
        $student = Auth::user()->student;
    
        // Dosyayı storage'a kaydediyoruz
        $cvPath = $request->file('cv')->store('cv_uploads', 'public');
    
        // Başvuruyu kaydet
        \App\Models\Application::create([
            'student_id' => $student->id,
            'internship_posting_id' => $id,
            'cv_path' => $cvPath,  // CV dosya yolu
            'status' => 'pending',
        ]);
    
        return redirect()->route('student.applications.index')->with('success', 'Başvurunuz alınmıştır.');
    }
    public function destroy($id)
{
    $application = \App\Models\Application::findOrFail($id);

    // Sadece kendi başvurusunu silebilsin
    if ($application->student_id !== Auth::user()->student->id) {
        abort(403, 'Bu başvuru size ait değil.');
    }

    $application->delete();

    return redirect()->route('student.applications.index')->with('success', 'Başvuru iptal edildi.');
}

}