<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.courses.index') }}" class="text-gray-500 hover:text-emerald-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Edit Kursus: {{ $course->title }}</h1>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200">
            <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Kursus</label>
                    <input type="text" name="title" value="{{ $course->title }}" required class="w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                    <select name="category_id" required class="w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">URL Gambar Sampul (Poster)</label>
                    <input type="url" name="image" value="{{ $course->image }}" required class="w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Kursus</label>
                    <textarea name="description" rows="4" required class="w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm">{{ $course->description }}</textarea>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>