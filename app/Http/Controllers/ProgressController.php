<?php

namespace App\Http\Controllers;

use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Mengambil seluruh riwayat kuis, memanggil relasi materi dan kursusnya sekaligus
        $progresses = UserProgress::with(['module.course'])
                        ->where('user_id', $user->id)
                        ->orderBy('updated_at', 'desc')
                        ->get();

        // Menghitung statistik untuk kartu ringkasan di bagian atas
        $totalKuis = $progresses->count();
        $kuisLulus = $progresses->where('is_completed', true)->count();
        
        // Menghitung nilai rata-rata keseluruhan (jika ada data)
        $rataRata = $totalKuis > 0 ? round($progresses->avg('score')) : 0;

        return view('progress.index', compact('progresses', 'totalKuis', 'kuisLulus', 'rataRata'));
    }
}