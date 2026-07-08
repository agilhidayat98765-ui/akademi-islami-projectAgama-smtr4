<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function download()
    {
        // 1. Mengambil data user yang sedang login saat ini
        $user = Auth::user();

        // 2. Menyiapkan data dinamis untuk dicetak ke PDF
        $data = [
            'nama_siswa' => $user->name,
            'tanggal'    => date('d F Y'),
            'kursus'     => 'Program Terpadu Akademi Islami'
        ];

        // 3. Memproses tampilan HTML menjadi PDF (A4 Landscape)
        $pdf = Pdf::loadView('certificate.pdf', $data)->setPaper('a4', 'landscape');

        // 4. Memaksa browser mengunduh file dengan nama dinamis
        return $pdf->download('Sertifikat_Kelulusan_' . $user->name . '.pdf');
    }
}