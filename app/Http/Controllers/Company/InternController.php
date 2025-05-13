<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;

class InternController extends Controller
{
    public function index()
    {
        $companyId = Auth::user()->company->id;

        $applications = Application::with(['student.user', 'internshipPosting'])
            ->whereHas('internshipPosting', fn($q) => $q->where('company_id', $companyId))
            ->latest()
            ->get();

        return view('company.interns.index', compact('applications'));
    }
}
