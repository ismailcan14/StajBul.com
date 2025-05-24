<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('user')->get();
        return view('admin.companies.index', compact('companies'));
    }

    public function show($id)
    {
        $company = Company::with('user')->findOrFail($id);
        return view('admin.companies.show', compact('company'));
    }

    public function destroy($id)
    {
        $company = Company::with(['internshipPostings', 'internships', 'user'])->findOrFail($id);
    
        // İlanlara bağlı başvuruları sil
        foreach ($company->internshipPostings as $posting) {
            $posting->applications()->delete(); // Eğer ilişkiliyse
            $posting->delete();
        }
    
        // Stajları sil
        $company->internships()->delete();
    
        // Şirket kaydını sil
        $company->delete();
    
        // En son user'ı sil
        if ($company->user) {
            $company->user->delete();
        }
    
        return redirect()->route('admin.companies.index')->with('success', 'Şirket ve ilişkili tüm veriler silindi.');
    }
    
}