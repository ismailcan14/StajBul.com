<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Internship;

class InternController extends Controller
{
    public function index(Request $request)
    {
        $companyId = Auth::user()->company->id;
        $filter = $request->query('filter', 'active'); // ✅ Varsayılan olarak 'active'

        // 🔹 Aktif stajyerler
        if ($filter === 'active') {
            $internships = Internship::with('student.user', 'internshipPosting')
                ->where('company_id', $companyId)
                ->whereNull('end_date')
                ->latest()
                ->get();

            return view('company.interns.index', [
                'internships' => $internships,
                'currentFilter' => 'active'
            ]);
        }

        // 🔹 Onaylı Ama Henüz Başlamamış
        if ($filter === 'accepted') {
            $applications = Application::with('student.user', 'internshipPosting')
                ->whereHas('internshipPosting', fn($q) => $q->where('company_id', $companyId))
                ->where('status', 'accepted')
                ->whereDoesntHave('student.internships', fn($q) =>
                    $q->where('company_id', $companyId)
                )
                ->latest()
                ->get();

            return view('company.interns.pending_accepteds', [
                'applications' => $applications,
                'currentFilter' => 'accepted'
            ]);
        }

        // 🔹 Reddedilen başvurular
        if ($filter === 'rejected') {
            $applications = Application::with('student.user', 'internshipPosting')
                ->whereHas('internshipPosting', fn($q) => $q->where('company_id', $companyId))
                ->where('status', 'rejected')
                ->latest()
                ->get();

            return view('company.interns.rejected', [
                'applications' => $applications,
                'currentFilter' => 'rejected'
            ]);
        }

        // Varsayılan dönüş (normalde buraya düşmez)
        return redirect()->route('company.interns.index', ['filter' => 'active']);
    }
}
