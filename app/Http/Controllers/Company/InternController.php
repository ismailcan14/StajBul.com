<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // BU SATIR ÖNEMLİ
use Illuminate\Support\Facades\Auth;
use App\Models\Application;

class InternController extends Controller
{
    public function index(Request $request)
{
    $companyId = Auth::user()->company->id;

    $filter = $request->query('filter');

    $applications = Application::with(['student.user', 'internshipPosting'])
        ->whereHas('internshipPosting', fn($q) => $q->where('company_id', $companyId));

    // Filtreye göre sorguyu daralt
    if ($filter === 'active') {
        $applications->where('status', 'accepted');
    } elseif ($filter === 'completed') {
        $applications->where('status', 'pending');
    } elseif ($filter === 'rejected') {
        $applications->where('status', 'rejected');
    }

    $applications = $applications->latest()->get();

    return view('company.interns.index', compact('applications'));
}
}
