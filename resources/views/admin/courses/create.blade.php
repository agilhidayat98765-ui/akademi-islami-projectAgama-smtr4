<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.courses.index') }}" class="text-gray-500 hover:text-emerald-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Tambah Kursus Baru</h1>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200">
            <form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Kursus</label>
                    <input type="text" name="title" required class="w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" placeholder="Contoh: Fiqih Wanita Dasar">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                    <select name="category_id" required class="w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">URL Gambar Sampul (Poster)</label>
                    <input type="url" name="image" required class="w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" placeholder="https://contoh.com/gambar.jpg">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Kursus</label>
                    <textarea name="description" rows="4" required class="w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm" placeholder="Jelaskan apa yang akan dipelajari di kursus ini..."></textarea>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all">
                        Simpan Kursus Baru
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>