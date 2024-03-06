<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentRequest;

class StudentController extends Controller
{
    /**
     * Menampilkan form untuk registrasi siswa baru.
     */
    public function create()
    {
        // Asumsikan kita memiliki model School untuk memilih asal sekolah
        $schools = School::all();
        return view('students.register', compact('schools'));
    }

    /**
     * Menyimpan siswa baru ke dalam database.
     */
    public function store(StoreStudentRequest $request)
    {
        // Buat user baru dengan data dari request
        $user = User::create($request->validated());

        // Tambahkan role 'student' ke user
        $user->assignRole('student');

        // Asumsikan setelah registrasi, siswa diarahkan ke halaman login
        // Atau sesuaikan redirect sesuai kebutuhan
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Tambahkan metode CRUD lainnya sesuai kebutuhan
}
