<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Öğrenci
use App\Http\Controllers\Student\InternshipController;
use App\Http\Controllers\Student\ApplicationController;
use App\Http\Controllers\Student\MessageController;
use App\Http\Controllers\Student\HistoryController;
use App\Http\Controllers\Student\ProfileController;

// Şirket
use App\Http\Controllers\Company\InternshipController as CompanyInternshipController;
use App\Http\Controllers\Company\ApplicationController as CompanyApplicationController;
use App\Http\Controllers\Company\InternController as CompanyInternController;
use App\Http\Controllers\Company\ProfileController as CompanyProfileController;
use App\Http\Controllers\Company\MessageController as CompanyMessageController;

// Admin
use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\InternshipPostingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CompanyController;



/*
|--------------------------------------------------------------------------
| Giriş & Kayıt Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Kayıt
Route::get('/register/student', [AuthController::class, 'showStudentRegisterForm'])->name('register.student.form');
Route::post('/register/student', [AuthController::class, 'registerStudent'])->name('register.student');

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
    Route::get('/dashboard', fn () => view('student.dashboard'))->name('student.dashboard');

    // Staj ilanları
    Route::get('/internships', [InternshipController::class, 'index'])->name('student.internships.index');
    Route::get('/internships/{id}', [InternshipController::class, 'show'])->name('student.internships.show');
    Route::post('/internships/{id}/apply', [ApplicationController::class, 'store'])->name('student.internships.apply');

    // Başvurular
    Route::get('/applications', [ApplicationController::class, 'index'])->name('student.applications.index');
    Route::delete('/applications/{id}', [ApplicationController::class, 'destroy'])->name('student.applications.destroy');
    Route::post('/applications/{id}/confirm', [ApplicationController::class, 'confirmAccepted'])->name('applications.confirm');

    // Mesajlar
    Route::get('/messages', [MessageController::class, 'index'])->name('student.messages.index');
    Route::get('/messages/{company_id}', [MessageController::class, 'chat'])->name('student.messages.chat');
    Route::post('/messages/send', [MessageController::class, 'send'])->name('student.messages.send');
    Route::post('/student/messages/fetch', [MessageController::class, 'fetchMessages'])->name('student.messages.fetch');

    // Aktif staj ve geçmiş
    Route::get('/active-internship', [InternshipController::class, 'active'])->name('student.internship.active');
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
    Route::get('/dashboard', fn () => view('company.dashboard'))->name('company.dashboard');

    // İlanlar
    Route::get('/internships', [CompanyInternshipController::class, 'index'])->name('company.internships.index');
    Route::get('/internships/create', [CompanyInternshipController::class, 'create'])->name('company.internships.create');
    Route::post('/internships', [CompanyInternshipController::class, 'store'])->name('company.internships.store');
    Route::get('/internships/{id}/edit', [CompanyInternshipController::class, 'edit'])->name('company.internships.edit');
    Route::put('/internships/{id}', [CompanyInternshipController::class, 'update'])->name('company.internships.update');
    Route::delete('/internships/{id}', [CompanyInternshipController::class, 'destroy'])->name('company.internships.destroy');

    // Başvurular
    Route::get('/applications', [CompanyInternshipController::class, 'applications'])->name('company.applications.index');
    Route::post('/applications/{id}/accept', [CompanyApplicationController::class, 'accept'])->name('company.applications.accept');
    Route::post('/applications/{id}/reject', [CompanyApplicationController::class, 'reject'])->name('company.applications.reject');

    // Profil
    Route::get('/profile/edit', [CompanyProfileController::class, 'edit'])->name('company.profile.edit');
    Route::post('/profile/update', [CompanyProfileController::class, 'update'])->name('company.profile.update');

    // Stajyerler
    Route::get('/interns', [CompanyInternController::class, 'index'])->name('company.interns.index');

    // 🔄 Stajı tamamlama (internship üzerinden)
    Route::get('/internships/complete/{internship}', [CompanyInternshipController::class, 'completeForm'])->name('company.internships.complete');
    Route::post('/internships/complete/{internship}', [CompanyInternshipController::class, 'storeCompletion'])->name('company.internships.complete.store');

    // Tamamlanan stajlar
    Route::get('/internships/completed', [CompanyInternshipController::class, 'completed'])->name('company.internships.completed');

    // Mesajlar
    Route::get('/messages', [CompanyMessageController::class, 'index'])->name('company.messages.index');
    Route::get('/messages/{student_id}', [CompanyMessageController::class, 'chat'])->name('company.messages.chat');
    Route::post('/messages/send', [CompanyMessageController::class, 'send'])->name('company.messages.send');
    Route::post('/company/messages/fetch', [CompanyMessageController::class, 'fetchMessages'])->name('company.messages.fetch');
});

/*
|--------------------------------------------------------------------------
| Admin Paneli Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'checkRole:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/applications', [AdminApplicationController::class, 'index'])->name('applications.index');
    Route::post('/applications/{id}/approve', [AdminApplicationController::class, 'approve'])->name('applications.approve');
    Route::post('/applications/{id}/reject', [AdminApplicationController::class, 'reject'])->name('applications.reject');
    Route::get('/applications/{id}', [AdminApplicationController::class, 'show'])->name('applications.show');

    Route::get('/internship-postings/pending', [\App\Http\Controllers\Admin\InternshipPostingController::class, 'pending'])->name('internship-postings.pending');
    Route::get('/internship-postings/{id}', [\App\Http\Controllers\Admin\InternshipPostingController::class, 'show'])->name('internship-postings.show');
    Route::post('/internship-postings/{id}/approve', [\App\Http\Controllers\Admin\InternshipPostingController::class, 'approve'])->name('internship-postings.approve');
    Route::post('/internship-postings/{id}/reject', [\App\Http\Controllers\Admin\InternshipPostingController::class, 'reject'])->name('internship-postings.reject');
    Route::get('/companies', [\App\Http\Controllers\Admin\CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/{id}', [\App\Http\Controllers\Admin\CompanyController::class, 'show'])->name('companies.show');
    Route::delete('/companies/{id}', [\App\Http\Controllers\Admin\CompanyController::class, 'destroy'])->name('companies.destroy');
    
    // Kullanıcı Yönetimi
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Oturum yönetimi
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});
