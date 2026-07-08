<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\AdminModuleController;
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
    Route::post('/modules/{module}/complete', [CourseController::class, 'markAsComplete'])->name('modules.complete');
    
    // Evaluasi / Kuis
    Route::get('/quiz/{module}', [QuizController::class, 'show'])->name('quiz.show');
    Route::post('/quiz/{module}', [QuizController::class, 'submit'])->name('quiz.submit');
    
    // Rapor Siswa
    Route::get('/rapor', [ProgressController::class, 'index'])->name('rapor.index');

    // Pengaturan Akun (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Fitur Tambahan
    Route::post('/courses/{course}/favorite', [CourseController::class, 'toggleFavorite'])->name('courses.favorite');
    Route::post('/chat', [ChatbotController::class, 'sendMessage'])->name('chat.send');
    Route::get('/certificate/download', [CertificateController::class, 'download'])->name('certificate.download');

    // PANEL ADMIN (Kelola Kursus & Modul Materi)
    Route::resource('admin/courses', AdminCourseController::class)->names('admin.courses');
    Route::resource('admin/modules', AdminModuleController::class)->except(['index', 'show'])->names('admin.modules');
});

require __DIR__.'/auth.php';