<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CourseController extends Controller
{
    public function __construct()
    {
        // Pastikan hanya super admin dan admin sekolah yang memiliki akses
        $this->middleware('permission:view courses', ['only' => ['index', 'show']]);
        $this->middleware('permission:create courses', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit courses', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete courses', ['only' => ['destroy']]);
    }

    /**
     * Menampilkan daftar kursus.
     */
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    /**
     * Menampilkan form untuk membuat kursus baru.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Menyimpan kursus baru ke dalam database.
     */
    public function store(StoreCourseRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $course = Course::create($request->all());

        return redirect()->route('courses.index')->with('success', 'Kursus berhasil ditambahkan.');
    }

    /**
     * Menampilkan kursus tertentu.
     */
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    /**
     * Menampilkan form untuk mengedit kursus.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Memperbarui kursus tertentu di database.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Kursus berhasil diperbarui.');
    }

    /**
     * Menghapus kursus tertentu dari database.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Kursus berhasil dihapus.');
    }
}
