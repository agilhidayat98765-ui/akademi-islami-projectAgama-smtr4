<x-app-layout>
    <div class="min-h-[80vh] flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-xl border border-gray-100 text-center transform transition-all duration-500 hover:scale-[1.01]">
            
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100 animate-pulse">
                <div class="h-16 w-16 rounded-full flex items-center justify-center shadow-lg transform scale-100 animate-bounce" style="background-color: #059669;">
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>

            <div class="space-y-3">
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    Maa Syaa Allah, Selamat!
                </h2>
                <p class="font-medium text-sm inline-block px-4 py-1.5 rounded-full" style="background-color: #d1fae5; color: #047857;">
                    Skor Sempurna: Lulus Evaluasi
                </p>
                <p class="text-gray-500 text-sm sm:text-base px-2 pt-2 leading-relaxed">
                    Kamu telah berhasil menyelesaikan seluruh rangkaian modul evaluasi dengan hasil yang luar biasa. Ilmu yang bermanfaat kini siap kamu amalkan!
                </p>
            </div>

            <div class="relative flex py-2 items-center">
                <div class="flex-grow border-t border-gray-200"></div>
                <span class="flex-shrink mx-4 text-gray-400 text-xs tracking-widest uppercase font-semibold">Reward Anda</span>
                <div class="flex-grow border-t border-gray-200"></div>
            </div>

            <div class="space-y-4 mt-4">
                
                <a href="{{ route('certificate.download') }}" 
                   class="w-full flex items-center justify-center gap-3 px-6 py-3.5 border border-transparent text-base font-bold rounded-xl shadow-md hover:shadow-xl transition-all"
                   style="background-color: #059669; color: #ffffff; text-decoration: none;">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Unduh E-Sertifikat Resmi
                </a>

                <a href="{{ route('courses.index') }}" 
                   class="w-full flex items-center justify-center px-6 py-3 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-colors"
                   style="text-decoration: none;">
                    Kembali ke Beranda Kursus
                </a>
                
            </div>

        </div>
    </div>
</x-app-layout>