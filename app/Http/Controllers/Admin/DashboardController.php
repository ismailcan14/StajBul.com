<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\InternshipPosting;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $companyCount = Company::count();
        $approvedPostings = InternshipPosting::where('is_approved', true)->count();
        $pendingPostings = InternshipPosting::where('is_approved', false)->count();

        return view('admin.dashboard', compact(
            'userCount',
            'companyCount',
            'approvedPostings',
            'pendingPostings'
        ));
    }
}