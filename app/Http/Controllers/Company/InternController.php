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
        $filter = $request->query('filter');

        // Stajı gerçekten başlayanlar (aktif stajyerler)
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

        // Henüz başlamamış ama başvurusu kabul edilmiş olanlar
      // Onaylı Ama Henüz Başlamamış
elseif ($filter === 'accepted') {
    $currentFilter = 'accepted';

    $applications = Application::with('student.user', 'internshipPosting')
        ->whereHas('internshipPosting', fn($q) => $q->where('company_id', $companyId))
        ->where('status', 'accepted')
        ->whereDoesntHave('student.internships', function ($q) use ($companyId) {
            $q->where('company_id', $companyId);
        })
        ->latest()
        ->get();

    return view('company.interns.pending_accepteds', compact('applications', 'currentFilter'));
}


        // Reddedilen başvurular
        elseif ($filter === 'rejected') {
            $currentFilter = 'rejected'; // ✅ eklendi

            $applications = Application::with('student.user', 'internshipPosting')
                ->whereHas('internshipPosting', fn($q) => $q->where('company_id', $companyId))
                ->where('status', 'rejected')
                ->latest()
                ->get();

            return view('company.interns.rejected', compact('applications', 'currentFilter'));
        }

        // Varsayılan olarak boş koleksiyon döndür
        return view('company.interns.index', [
            'internships' => collect(),
            'currentFilter' => 'active'
        ]);
    }
}
