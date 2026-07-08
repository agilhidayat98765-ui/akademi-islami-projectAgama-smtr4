<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // 1. Menampilkan halaman "Kursus Saya" (Tab Sedang Dipelajari, Selesai, & Favorit)
    public function index()
    {
        $user = Auth::user();
        
        $allCourses = Course::with(['category', 'modules'])->get();
        
        $courses = collect(); 
        $completedCourses = collect(); 

        foreach ($allCourses as $course) {
            $totalModules = $course->modules->count();
            
            if ($totalModules > 0) {
                $lulusCount = \App\Models\UserProgress::where('user_id', $user->id)
                    ->whereIn('module_id', $course->modules->pluck('id'))
                    ->where('is_completed', true)
                    ->count();

                // Jika sudah ada kuis materi yang lulus, masukkan ke tab Selesai
                if ($lulusCount > 0) {
                    $completedCourses->push($course);
                } else {
                    $courses->push($course);
                }
            } else {
                $courses->push($course);
            }
        }

        $favoriteCourses = $user->favoriteCourses()->with('category')->get();

        return view('courses.index', compact('courses', 'completedCourses', 'favoriteCourses'));
    }

    // 2. Fungsi untuk mengarahkan ke materi pertama saat kursus diklik
    public function show(Course $course)
    {
        $firstModule = $course->modules()->orderBy('order', 'asc')->first();

        if ($firstModule) {
            return redirect()->route('modules.show', $firstModule->id);
        }

        return back()->with('error', 'Materi belum tersedia untuk kursus ini.');
    }

    // 3. Menampilkan halaman materi dan video
    public function showModule(Module $module)
    {
        $course = $module->course()->with(['modules' => function($query) {
            $query->orderBy('order', 'asc');
        }])->first();

        return view('modules.show', compact('module', 'course'));
    }

    // 4. Mengaktifkan/mematikan tombol favorit (ikon hati)
    public function toggleFavorite(Course $course)
    {
        Auth::user()->favoriteCourses()->toggle($course->id);
        return back();
    }

    // 5. Fitur Tandai Selesai secara manual (dipanggil oleh Route)
    public function markAsComplete(Request $request, Module $module)
    {
        \App\Models\UserProgress::updateOrCreate(
            ['user_id' => Auth::id(), 'module_id' => $module->id],
            ['is_completed' => true, 'score' => 100]
        );

        return back()->with('success', 'Materi berhasil ditandai selesai.');
    }
}