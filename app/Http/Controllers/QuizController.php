<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Question;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    // Menampilkan halaman kuis
    public function show(Module $module)
    {
        // Mengambil soal secara acak (dibatasi 10 soal maksimal)
        $questions = $module->questions()->inRandomOrder()->limit(10)->get();
        
        if ($questions->isEmpty()) {
            return back()->with('error', 'Kuis untuk modul ini belum tersedia.');
        }

        return view('quiz.show', compact('module', 'questions'));
    }

    // Memproses jawaban kuis
    public function submit(Request $request, Module $module)
    {
        $questions = $module->questions()->get();
        $correctAnswers = 0;
        $totalQuestions = $questions->count();

        // Menghitung jawaban yang benar
        foreach ($questions as $question) {
            $userAnswer = $request->input('answers.' . $question->id);
            if ($userAnswer === $question->correct_answer) {
                $correctAnswers++;
            }
        }

        // Menghitung nilai (0 - 100)
        $score = ($totalQuestions > 0) ? round(($correctAnswers / $totalQuestions) * 100) : 0;
        $isPassed = $score >= 70;

        // Menyimpan progres ke database
        UserProgress::updateOrCreate(
            ['user_id' => Auth::id(), 'module_id' => $module->id],
            ['score' => $score, 'is_completed' => $isPassed]
        );

        if ($isPassed) {
            // Mengarahkan ke halaman selebrasi sertifikat
            return view('quiz.success');
        } else {
            // Tetap di halaman kuis agar siswa bisa mencoba lagi
            return redirect()->back()->with('error', "Nilai Anda $score. Belum mencapai batas lulus (70). Silakan coba lagi ya!");
        }
    }
}