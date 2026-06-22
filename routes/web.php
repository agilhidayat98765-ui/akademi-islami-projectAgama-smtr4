<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

// Halaman utama (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// Kelompok rute yang butuh Login (hanya bisa diakses kalau sudah masuk)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Beranda Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Menu "Kursus Saya" & Detail Modul
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/modules/{module}', [CourseController::class, 'showModule'])->name('modules.show');

    // Fitur Tandai Selesai di Materi
    Route::post('/modules/{module}/complete', [CourseController::class, 'markAsComplete'])->name('modules.complete');

    // Evaluasi / Kuis
    Route::get('/quiz/{module}', [QuizController::class, 'show'])->name('quiz.show');
    Route::post('/quiz/{module}', [QuizController::class, 'submit'])->name('quiz.submit');

    // Pengaturan Akun (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Fitur Favorit Kursus
    Route::post('/courses/{course}/favorite', [CourseController::class, 'toggleFavorite'])->name('courses.favorite');
});

require __DIR__.'/auth.php';