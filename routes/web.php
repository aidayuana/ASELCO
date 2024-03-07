<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

// Home Page Route
Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();

// Dashboard Routes
Route::middleware(['auth'])->group(function () {
    // Super Admin Dashboard
    Route::get('/dashboard/super_admin', [DashboardController::class, 'superAdmin'])->name('dashboard.super_admin')->middleware('can:manage-system');

    // School Admin Dashboard
    Route::get('/dashboard/school-admin', [DashboardController::class, 'schoolAdmin'])->name('dashboard.schooladmin')->middleware('can:manage-school');

    // Teacher Dashboard
    Route::get('/dashboard/teacher', [DashboardController::class, 'teacher'])->name('dashboard.teacher')->middleware('can:manage-courses');

    // Student Dashboard
    Route::get('/dashboard/student', [DashboardController::class, 'student'])->name('dashboard.student')->middleware('can:view-courses');
});

// School Routes
Route::middleware(['auth', 'can:manage-schools'])->group(function () {
    Route::resource('schools', SchoolController::class);
});

// Course Routes
Route::middleware(['auth', 'can:manage-courses'])->group(function () {
    Route::resource('courses', CourseController::class);
});

// Teacher Routes - Misalnya untuk menambah, mengedit, dan menghapus guru oleh admin sekolah
Route::middleware(['auth', 'can:manage-teachers'])->group(function () {
    Route::resource('teachers', TeacherController::class);
});

// Student Routes - Khusus untuk registrasi siswa
// Registrasi siswa bisa diakses tanpa autentikasi karena asumsinya siswa mendaftar sendiri
Route::get('students/register', [StudentController::class, 'create'])->name('students.register');
Route::post('students', [StudentController::class, 'store'])->name('students.store');


// Login Route
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('/get-classes/{schoolId}', [ClassesController::class, 'getClasses'])->name('get.classes');



// Login dan Registrasi untuk Siswa
// Jika menggunakan Laravel Breeze atau Jetstream, Anda mungkin tidak perlu route khusus ini karena sudah termasuk dalam scaffolding