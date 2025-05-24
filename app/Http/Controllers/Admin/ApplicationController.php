<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternshipPosting;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $postings = InternshipPosting::with('company')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.applications.index', compact('postings'));
    }
    public function show($id)
{
    $posting = InternshipPosting::with('company')->findOrFail($id);
    
    return view('admin.applications.show', compact('posting'));
}


    public function approve($id)
    {
        $posting = InternshipPosting::findOrFail($id);
        $posting->is_approved = true;
        $posting->save();

        return redirect()->back()->with('success', 'İlan onaylandı.');
    }

    public function reject($id)
    {
        $posting = InternshipPosting::findOrFail($id);
        $posting->is_approved = false;
        $posting->save();

        return redirect()->back()->with('success', 'İlan reddedildi.');
    }
}