<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Student\InternshipController;
use App\Http\Controllers\Student\ApplicationController;
use App\Http\Controllers\Student\MessageController;
use App\Http\Controllers\Student\HistoryController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Company\InternshipController as CompanyInternshipController;
use App\Http\Controllers\Company\ProfileController as CompanyProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Company\ApplicationController as CompanyApplicationController;
use App\Http\Controllers\Company\InternController as CompanyInternController;


/*
|--------------------------------------------------------------------------
| Giriş & Kayıt Routes
|--------------------------------------------------------------------------
*/

// Giriş ve çıkış
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Öğrenci kayıt
Route::get('/register/student', [AuthController::class, 'showStudentRegisterForm'])->name('register.student.form');
Route::post('/register/student', [AuthController::class, 'registerStudent'])->name('register.student');

// Şirket kayıt
Route::get('/register/company', [AuthController::class, 'showCompanyRegisterForm'])->name('register.company.form');
Route::post('/register/company', [AuthController::class, 'registerCompany'])->name('register.company');

/*
|--------------------------------------------------------------------------
| Ana Sayfa
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Öğrenci Paneli Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('student')->group(function () {

    // Dashboard
    Route::get('/dashboard', fn() => view('student.dashboard'))->name('student.dashboard');

    // Staj ilanları
    Route::get('/internships', [InternshipController::class, 'index'])->name('student.internships.index');
    Route::get('/internships/{id}', [InternshipController::class, 'show'])->name('student.internships.show');
    Route::post('/internships/{id}/apply', [ApplicationController::class, 'store'])->name('student.internships.apply');

    // Başvurular
    Route::get('/applications', [ApplicationController::class, 'index'])->name('student.applications.index');
    Route::delete('/applications/{id}', [ApplicationController::class, 'destroy'])->name('student.applications.destroy');

    // Mesajlar
    Route::get('/messages', [MessageController::class, 'index'])->name('student.messages.index');
    Route::get('/messages/{company_id}', [MessageController::class, 'chat'])->name('student.messages.chat');
    Route::post('/messages/send', [MessageController::class, 'send'])->name('student.messages.send');

    // Staj geçmişi
    Route::get('/history', [HistoryController::class, 'index'])->name('student.history.index');

    // Profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('student.profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('student.profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('student.profile.update');
});

/*
|--------------------------------------------------------------------------
| Şirket Paneli Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('company')->group(function () {

    // Dashboard
    Route::get('/dashboard', fn() => view('company.dashboard'))->name('company.dashboard');

    // Staj ilanları
    Route::get('/internships', [CompanyInternshipController::class, 'index'])->name('company.internships.index');
    Route::get('/internships/create', [CompanyInternshipController::class, 'create'])->name('company.internships.create');
    Route::post('/internships', [CompanyInternshipController::class, 'store'])->name('company.internships.store');
    Route::get('/internships/{id}/edit', [CompanyInternshipController::class, 'edit'])->name('company.internships.edit');
    Route::put('/internships/{id}', [CompanyInternshipController::class, 'update'])->name('company.internships.update');
    Route::delete('/internships/{id}', [CompanyInternshipController::class, 'destroy'])->name('company.internships.destroy');

    // Başvurular
    Route::get('/applications', [CompanyInternshipController::class, 'applications'])->name('company.applications.index');

    // Profil
    Route::get('/profile/edit', [CompanyProfileController::class, 'edit'])->name('company.profile.edit');
    Route::post('/profile/update', [CompanyProfileController::class, 'update'])->name('company.profile.update');

    //staj onay ve red
    Route::post('/applications/{id}/accept', [CompanyApplicationController::class, 'accept'])->name('company.applications.accept');
    Route::post('/applications/{id}/reject', [CompanyApplicationController::class, 'reject'])->name('company.applications.reject');

    //stajyerler
Route::get('/interns', [CompanyInternController::class, 'index'])->name('company.interns.index');


});
