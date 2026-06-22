<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Menampilkan halaman "Kursus Saya" beserta daftar favorit
    public function index()
    {
        $courses = Course::with('category')->get();

        // Mengambil daftar kursus yang hanya difavoritkan oleh user yang sedang login
        $favoriteCourses = Auth::user()->favoriteCourses()->with('category')->get();

        return view('courses.index', compact('courses', 'favoriteCourses'));
    }

    public function show(Course $course)
    {
        $firstModule = $course->modules()->orderBy('order', 'asc')->first();

        if ($firstModule) {
            return redirect()->route('modules.show', $firstModule->id);
        }

        return back()->with('error', 'Materi belum tersedia untuk kursus ini.');
    }

    public function showModule(Module $module)
    {
        $course = $module->course()->with(['modules' => function($query) {
            $query->orderBy('order', 'asc');
        }])->first();

        return view('modules.show', compact('module', 'course'));
    }

    // Fungsi mengaktifkan/mematikan tombol favorit
    public function toggleFavorite(Course $course)
    {
        Auth::user()->favoriteCourses()->toggle($course->id);
        return back();
    }
}