<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use Database\Seeders\ClassesSeeder;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller
{
    public function __construct()
    {
        // Membatasi akses hanya untuk super admin pada semua fungsi kecuali 'show'
        $this->middleware('can:manage-schools')->except('show');
    }

    /**
     * Menampilkan daftar sekolah.
     */
    public function index()
    {
        $schools = School::all();
        return view('schools.index', compact('schools'));
    }

    /**
     * Menampilkan form untuk membuat sekolah baru.
     */
    public function create()
    {
        return view('schools.create');
    }

    /**
     * Menyimpan sekolah baru ke dalam database.
     */
    public function store(StoreSchoolRequest $request)
    {
        $school = School::create($request->validated());
        return redirect()->route('schools.index')->with('success', 'Sekolah berhasil ditambahkan.');
    }

    /**
     * Menampilkan sekolah tertentu.
     */
    public function show(School $school)
    {
        return view('schools.show', compact('school'));
    }

    /**
     * Menampilkan form untuk mengedit sekolah tertentu.
     */
    public function edit(School $school)
    {
        return view('schools.edit', compact('school'));
    }

    /**
     * Memperbarui sekolah tertentu dalam database.
     */
    public function update(UpdateSchoolRequest $request, School $school)
    {
        $school->update($request->validated());
        return redirect()->route('schools.index')->with('success', 'Sekolah berhasil diperbarui.');
    }

    /**
     * Menghapus sekolah tertentu dari database.
     */
    public function destroy(School $school)
    {
        $school->delete();
        return back()->with('success', 'Sekolah berhasil dihapus.');
    }
    public function getClasses(Request $request, $schoolId)
    {
        // Memastikan bahwa hanya angka yang diterima untuk mencegah SQL injection
        if (!is_numeric($schoolId)) {
            return response()->json(['error' => 'Invalid school ID'], 400);
        }

        $classes = Classes::where('school_id', $schoolId)->get(['id', 'class_name']);

        return response()->json($classes);
    }
}
