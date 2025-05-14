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
            'class' => 'required|string|max:255',
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:6|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        // Şifre güncellenecekse eski şifre doğru mu kontrol et
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Mevcut şifreniz yanlış.']);
            }
    
            $user->password = bcrypt($request->password);
        }
    
        $user->email = $request->email;
        $user->save();
    
        $student->class = $request->class;
    
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $student->profile_photo = $path;
        }
    
        $student->save();
    
        return redirect()->route('student.profile')->with('success', 'Profiliniz güncellendi.');
    }}