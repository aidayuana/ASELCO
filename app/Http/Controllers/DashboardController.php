<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan semua akses dashboard memerlukan autentikasi

        // Middleware 'can' untuk mengecek permission
        $this->middleware('can:manage-system')->only('superAdmin');
        $this->middleware('can:manage-school')->only('schoolAdmin');
        $this->middleware('can:manage-courses')->only('teacher');
        $this->middleware('can:view-courses')->only('student');
    }

    /**
     * Menampilkan dashboard untuk Super Admin.
     */
    public function superAdmin()
    {
        return view('dashboard.superadmin');
    }

    /**
     * Menampilkan dashboard untuk Admin Sekolah.
     */
    public function schoolAdmin()
    {
        return view('dashboard.schooladmin');
    }

    /**
     * Menampilkan dashboard untuk Guru.
     */
    public function teacher()
    {
        return view('dashboard.teacher');
    }

    /**
     * Menampilkan dashboard untuk Siswa.
     */
    public function student()
    {
        return view('dashboard.student');
    }
}
