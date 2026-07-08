<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.courses.index') }}" class="text-gray-500 hover:text-emerald-600 bg-white p-2 rounded-full shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Kelola Materi: {{ $course->title }}</h1>
                    <p class="text-gray-500 text-sm mt-1">Atur urutan modul, teks bacaan, video, dan soal kuis.</p>
                </div>
            </div>
            <a href="{{ route('admin.modules.create', ['course_id' => $course->id]) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-5 rounded-lg shadow-md transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Modul Baru
            </a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded-r-lg">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg">{{ session('error') }}</div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Urutan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Judul Modul</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Total Kuis</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($modules as $mod)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-center font-bold text-gray-900 text-lg">{{ $mod->order }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $mod->title }}
                                @if($mod->video_url)
                                    <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                        Ada Video
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center text-sm font-bold text-orange-600">
                                {{ $mod->questions()->count() }} Soal
                            </td>
                            <td class="px-6 py-4 text-center text-sm font-medium">
                                <div class="flex justify-center space-x-2">
                                    <a href="#" class="text-orange-600 hover:text-white border border-orange-500 hover:bg-orange-500 px-3 py-1.5 rounded-lg transition-colors font-bold text-xs flex items-center">
                                        Kelola Kuis
                                    </a>
                                    
                                    <a href="{{ route('admin.modules.edit', $mod->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 p-2 rounded-lg">Edit</a>
                                    <form action="{{ route('admin.modules.destroy', $mod->id) }}" method="POST" onsubmit="return confirm('Yakin hapus modul ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-2 rounded-lg">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada modul di kursus ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>