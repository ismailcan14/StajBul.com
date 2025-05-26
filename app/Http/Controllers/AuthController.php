<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;

class AuthController extends Controller
{
    public function showStudentRegisterForm()
    {
        $departments = Department::all();
        return view('auth.register-student', compact('departments'));
    }

    public function showCompanyRegisterForm()
    {
        return view('auth.register-company');
    }

    public function registerStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'student_number' => 'required|unique:students',
            'department_id' => 'required|numeric',
            'class' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        $user->student()->create([
            'student_number' => $request->student_number,
            'department_id' => $request->department_id,
            'class' => $request->class,
        ]);

        Auth::login($user);
        return redirect()->route('student.dashboard');
    }

    public function registerCompany(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'company_name' => 'required|string',
            'tax_number' => 'required|string',
            'authorized_person' => 'required|string',
            'address' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'company',
        ]);

        $user->company()->create([
            'company_name' => $request->company_name,
            'tax_number' => $request->tax_number,
            'authorized_person' => $request->authorized_person,
            'address' => $request->address,
        ]);

        Auth::login($user);
        return redirect()->route('company.dashboard');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember'); 

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $user = Auth::user();
            return match ($user->role) {
                'student' => redirect()->route('student.dashboard'),
                'company' => redirect()->route('company.dashboard'),
                'admin' => redirect()->route('admin.dashboard'),
                default => abort(403),
            };
        }

        return back()->withErrors(['email' => 'Email veya şifre yanlış'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
