<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\InternshipPosting;
use Carbon\Carbon;

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
        $internships = Auth::user()->company->internshipPostings()->latest()->get();
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
}
