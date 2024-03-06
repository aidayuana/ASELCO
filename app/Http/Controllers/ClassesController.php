<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Contoh: Hanya super admin dan admin sekolah yang bisa melihat semua kelas
        if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'school_admin') {
            $classes = Classes::with('school')->get(); // Menggunakan eager loading untuk memuat data sekolah terkait
            return view('classes.index', compact('classes'));
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk melihat daftar kelas.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pastikan hanya super admin atau admin sekolah yang dapat membuat kelas baru
        if (Auth::user()->role != 'super_admin' && Auth::user()->role != 'school_admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk membuat kelas baru.');
        }

        $schools = School::all(); // Ambil semua sekolah untuk dropdown
        return view('classes.create', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'school_name' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
        ]);

        // Membuat kelas baru
        Classes::create($request->all());

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classes $classModel)
    {
        // Tampilkan detail kelas
        return view('classes.show', compact('classes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classes $classes)
    {
        // Pastikan hanya super admin atau admin sekolah yang dapat mengedit kelas
        if (Auth::user()->role != 'super_admin' && Auth::user()->role != 'school_admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengedit kelas.');
        }

        $schools = School::all(); // Untuk dropdown sekolah
        return view('classes.edit', compact('classes', 'schools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classes $classModel)
    {
        // Validasi request
        $request->validate([
            'school_name' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
        ]);

        // Update kelas
        $classModel->update($request->all());

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classes $classModel)
    {
        // Pastikan hanya super admin yang dapat menghapus kelas
        if (Auth::user()->role != 'super_admin') {
            return redirect()->back()->with('error', 'Hanya super admin yang dapat menghapus kelas.');
        }

        $classModel->delete();

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dihapus.');
    }
    public function getClasses($schoolId) {
        $classes = Classes::where('school_id', $schoolId)->get();
        return response()->json($classes);
    }

}
