<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;
        $user = auth()->user();
    
        return view('student.profile.index', compact('student', 'user'));
    }
    
    public function edit()
    {
        $student = auth()->user()->student;
        $user = auth()->user();
    
        return view('student.profile.edit', compact('student', 'user'));
    }
    
    public function update(Request $request)
{
    $user = auth()->user();
    $student = $user->student;

    $request->validate([
        'email' => 'required|email',
        'password' => 'nullable|min:6',
        'class' => 'required|string',
        'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user->email = $request->email;
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }
    $user->save();

    $student->class = $request->class;

    // ✅ Dosya yüklendiyse Storage'a kaydet
    if ($request->hasFile('profile_photo')) {
          // Önce eski dosya varsa sil
    if ($student->profile_photo && Storage::disk('public')->exists($student->profile_photo)) {
        Storage::disk('public')->delete($student->profile_photo);
    }

    // Yeni dosyayı kaydet
    $path = $request->file('profile_photo')->store('profile_photos', 'public');
    $student->profile_photo = $path;
    }

    $student->save();

    return redirect()->route('student.profile')->with('success', 'Profil başarıyla güncellendi.');
}}