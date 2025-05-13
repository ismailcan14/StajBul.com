<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function accept($id)
    {
        $application = \App\Models\Application::findOrFail($id);
        $application->status = 'accepted';
        $application->save();

        return redirect()->back()->with('success', 'Başvuru onaylandı.');
    }

    public function reject($id)
    {
        $application = \App\Models\Application::findOrFail($id);
        $application->status = 'rejected';
        $application->save();

        return redirect()->back()->with('success', 'Başvuru reddedildi.');
    }
}
