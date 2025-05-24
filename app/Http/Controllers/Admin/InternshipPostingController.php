<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternshipPosting;

class InternshipPostingController extends Controller
{
    public function pending()
    {
        $postings = InternshipPosting::with('company')
            ->where('is_approved', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.postings.pending', compact('postings'));
    }

    public function show($id)
    {
        $posting = InternshipPosting::with('company')->findOrFail($id);
        return view('admin.postings.show', compact('posting'));
    }

    public function approve($id)
    {
        $posting = InternshipPosting::findOrFail($id);
        $posting->is_approved = true;
        $posting->save();

        return redirect()->route('admin.internship-postings.pending')->with('success', 'İlan onaylandı.');
    }

    public function reject($id)
    {
        $posting = InternshipPosting::findOrFail($id);
        $posting->is_approved = false;
        $posting->save();

        return redirect()->route('admin.internship-postings.pending')->with('success', 'İlan reddedildi.');
    }
}