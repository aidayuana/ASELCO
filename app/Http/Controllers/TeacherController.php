<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function __construct()
    {
        // Pastikan hanya pengguna yang memiliki permission yang dapat mengakses
        $this->middleware('can:manage-teachers');
    }

    /**
     * Menampilkan daftar guru.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Menampilkan form untuk membuat guru baru.
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Menyimpan guru baru ke dalam database.
     */
    public function store(StoreTeacherRequest $request)
    {
        $teacher = Teacher::create($request->validated());
        return redirect()->route('teachers.index')->with('success', 'Guru berhasil ditambahkan.');
    }

    /**
     * Menampilkan guru tertentu.
     */
    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Menampilkan form untuk mengedit guru tertentu.
     */
    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Memperbarui guru tertentu dalam database.
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->validated());
        return redirect()->route('teachers.index')->with('success', 'Guru berhasil diperbarui.');
    }

    /**
     * Menghapus guru tertentu dari database.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return back()->with('success', 'Guru berhasil dihapus.');
    }
}
