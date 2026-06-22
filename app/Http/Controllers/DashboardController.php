<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Mengambil semua data kursus (misal: Fiqih Ibadah, Sejarah Islam)
        $courses = Course::with('category')->get();

        // Di sini nantinya kita ambil progres belajar user
        // Untuk sekarang, kita kirim data kursusnya dulu ke tampilan
        return view('dashboard', [
            'user' => $user,
            'courses' => $courses
        ]);
    }
}