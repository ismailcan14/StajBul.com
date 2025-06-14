<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\InternshipPosting;
use App\Models\Application;
use App\Models\Internship;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;



class InternshipController extends Controller
{
    public function create()
    {
        return view('company.internships.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'quota' => 'required|integer|min:1',
            'city' => 'required|string',
            'application_deadline' => 'required|date|after:today',
        ]);

        InternshipPosting::create([
            'company_id' => Auth::user()->company->id,
            'title' => $request->title,
            'description' => $request->description,
            'quota' => $request->quota,
            'city' => $request->city,
            'application_deadline' => $request->application_deadline,
        ]);

        return redirect()->route('company.dashboard')->with('success', 'İlan başarıyla oluşturuldu.');
    }

    public function applications()
    {
        $company = Auth::user()->company;

        $internshipPostings = $company->internshipPostings()->with(['applications.student.user'])->get();

        return view('company.applications.index', compact('internshipPostings'));
    }

    public function index()
    {
    $internships = Auth::user()->company
    ->internshipPostings()
    ->where('is_approved', true)
    ->latest()
    ->get();

return view('company.internships.index', compact('internships'));

    }

    public function edit($id)
    {
        $internship = Auth::user()->company->internshipPostings()->findOrFail($id);
        $internship->application_deadline = Carbon::parse($internship->application_deadline); // format için
        return view('company.internships.edit', compact('internship'));
    }

    public function update(Request $request, $id)
    {
        $internship = Auth::user()->company->internshipPostings()->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'quota' => 'required|integer|min:1',
            'city' => 'required|string',
            'application_deadline' => 'required|date|after:today',
        ]);

        $internship->update($request->only(['title', 'description', 'quota', 'city', 'application_deadline']));

        return redirect()->route('company.internships.index')->with('success', 'İlan başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $internship = Auth::user()->company->internshipPostings()->findOrFail($id);
        $internship->delete();

        return redirect()->route('company.internships.index')->with('success', 'İlan silindi.');
    }

   public function completeForm(\App\Models\Internship $internship)
{
    return view('company.interns.complete', compact('internship'));
}

public function storeCompletion(Request $request, \App\Models\Internship $internship)
{
    $validatedData = $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'report_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);

    // Dosya kaydı
    if ($request->hasFile('report_file')) {
        $path = $request->file('report_file')->store('report_files', 'public');
    }

    $internship->update([
        'start_date' => $validatedData['start_date'],
        'end_date' => $validatedData['end_date'],
        'report_file_url' => 'storage/' . $path,
    ]);

    return redirect()->route('company.interns.index')->with('success', 'Staj başarıyla tamamlandı.');
}


public function completed()
{
    $companyId = Auth::user()->company->id;

    $internships = \App\Models\Internship::with('student.user')
        ->where('company_id', $companyId)
        ->whereNotNull('end_date') // ✅ EN ÖNEMLİ KISIM
        ->latest()
        ->get();

    return view('company.internships.completed', compact('internships'));
}

}
