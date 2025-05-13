<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $company = Auth::user()->company;
        return view('company.profile.edit', compact('company'));
    }

   public function update(Request $request)
{
    $company = Auth::user()->company;

    $request->validate([
        'company_name' => 'required|string|max:255',
        'tax_number' => 'required|string|max:50',
        'authorized_person' => 'required|string|max:100',
        'address' => 'required|string|max:500',
        'logo' => 'nullable|url',
    ]);

    $data = $request->only(['company_name', 'tax_number', 'authorized_person', 'address', 'logo']);

    $company->update($data);

    return redirect()->route('company.profile.edit')->with('success', 'Profil başarıyla güncellendi.');
}

}
