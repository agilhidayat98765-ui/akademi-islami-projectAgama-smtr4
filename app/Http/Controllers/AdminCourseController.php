<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')->latest()->get();
        return view('admin.courses.index', compact('courses'));
    }

    // FUNGSI BARU: Menampilkan daftar modul di dalam sebuah kursus
    public function show(Course $course)
    {
        $modules = $course->modules()->orderBy('order', 'asc')->get();
        return view('admin.courses.show', compact('course', 'modules'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255', 'description' => 'required', 'category_id' => 'required', 'image' => 'required']);
        $course = new Course();
        $course->title = $request->title;
        $course->slug = Str::slug($request->title);
        $course->description = $request->description;
        $course->category_id = $request->category_id;
        $course->image = $request->image;
        $course->save();
        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil ditambahkan!');
    }

    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('admin.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate(['title' => 'required|string|max:255', 'description' => 'required', 'category_id' => 'required', 'image' => 'required']);
        $course->title = $request->title;
        $course->slug = Str::slug($request->title);
        $course->description = $request->description;
        $course->category_id = $request->category_id;
        $course->image = $request->image;
        $course->save();
        return redirect()->route('admin.courses.index')->with('success', 'Perubahan disimpan!');
    }

    public function destroy(Course $course)
    {
        try {
            $course->delete();
            return back()->with('success', 'Kursus dihapus secara permanen.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal dihapus! Hapus materi di dalamnya terlebih dahulu.');
        }
    }
}