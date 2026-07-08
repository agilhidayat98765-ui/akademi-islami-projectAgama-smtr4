<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.courses.show', $course->id) }}" class="text-gray-500 hover:text-emerald-600 bg-white p-2 rounded-full shadow-sm transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Tambah Modul Baru</h1>
                <p class="text-gray-500 mt-1">Untuk Kursus: <strong class="text-emerald-700">{{ $course->title }}</strong></p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200">
            <form action="{{ route('admin.modules.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <input type="hidden" name="course_id" value="{{ $course->id }}">

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="md:col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Urutan Ke-</label>
                        <input type="number" name="order" required min="1" class="w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" placeholder="Contoh: 1">
                    </div>
                    
                    <div class="md:col-span-3">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Judul Modul/Materi</label>
                        <input type="text" name="title" required class="w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" placeholder="Contoh: Pengenalan Huruf Hijaiyah">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">URL Video YouTube (Opsional)</label>
                    <input type="url" name="video_url" class="w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" placeholder="Contoh: https://www.youtube.com/embed/xxxxxx">
                    <p class="text-xs text-gray-500 mt-1">*Kosongkan jika materi ini hanya berupa teks bacaan.</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Isi Materi Pembelajaran (Teks/HTML)</label>
                    <textarea name="content" rows="10" required class="w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" placeholder="Ketikkan isi penjelasan materi di sini... Anda bisa menggunakan tag HTML seperti <b> atau <p> untuk merapikan teks."></textarea>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition-all focus:ring-4 focus:ring-emerald-300">
                        Simpan Modul
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>