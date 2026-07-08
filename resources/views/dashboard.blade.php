<x-app-layout>
    <div class="max-w-5xl mx-auto space-y-8">
        
        <div>
            <p class="text-sm text-gray-500 mb-1">{{ now()->translatedFormat('l, d F Y') }}</p>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang, {{ Auth::user()->name }}</h1>
            <p class="text-gray-600">Semoga Allah memberkahi waktu belajar Anda hari ini. Mari lanjutkan perjalanan menuntut ilmu.</p>
        </div>

        <div class="bg-gradient-to-r from-emerald-700 to-teal-900 rounded-2xl p-6 shadow-xl text-white flex flex-col md:flex-row items-center justify-between gap-4 border border-emerald-600 transform transition-all hover:scale-[1.01]">
            <div class="flex items-center gap-4 w-full">
                <div class="p-3 bg-white bg-opacity-20 rounded-xl shrink-0">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold">Panel Administrator</h2>
                    <p class="text-emerald-100 text-sm mt-1">Akses cepat untuk Tambah, Edit, dan Hapus kursus.</p>
                </div>
            </div>
            <a href="{{ route('admin.courses.index') }}" class="w-full md:w-auto text-center bg-white text-emerald-800 hover:bg-emerald-50 focus:ring-4 focus:ring-emerald-300 font-bold py-3 px-6 rounded-xl shadow-md transition-all whitespace-nowrap">
                Buka Kelola Kursus &rarr;
            </a>
        </div>

        <div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-900">Progres Belajar</h2>
                <a href="{{ route('courses.index') }}" class="text-sm text-emerald-600 hover:underline">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-xl border border-gray-200 flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full border-4 border-emerald-600 flex items-center justify-center text-sm font-bold text-emerald-800">
                        75%
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Fiqih</p>
                        <p class="font-bold text-gray-900">Fiqih Ibadah</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-xl font-bold text-gray-900 mb-4">Modul Tersedia</h2>
            
            @if($courses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($courses as $course)
                     <div class="relative bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-md hover:border-emerald-400 transition-all group">

                         <form action="{{ route('courses.favorite', $course->id) }}" method="POST" class="absolute top-3 right-3 z-20">
                             @csrf
                             <button type="submit" class="p-2 rounded-full bg-white bg-opacity-80 hover:bg-opacity-100 shadow-sm text-gray-400 hover:text-red-500 transition-colors focus:outline-none">
                                 @if(Auth::user()->favoriteCourses->contains($course->id))
                                     <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                 @else
                                     <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                 @endif
                             </button>
                         </form>

                         <a href="{{ route('courses.show', $course->slug) }}" class="block h-full">
                             <div class="h-40 bg-gray-200 relative overflow-hidden">
                                 <img src="{{ $course->image }}" alt="{{ $course->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                 <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                     <span class="text-white font-bold tracking-wider drop-shadow-md">{{ $course->category->name ?? 'Kategori' }}</span>
                                 </div>
                             </div>
                             <div class="p-5">
                                 <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-emerald-700 transition-colors">{{ $course->title }}</h3>
                                 <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $course->description }}</p>
                                 <div class="flex items-center justify-between">
                                     <span class="text-xs text-gray-500"> 📖  Mulai Belajar</span>
                                     <span class="text-emerald-600 font-medium text-sm group-hover:text-emerald-800">Lihat Modul &rarr;</span>
                                 </div>
                             </div>
                         </a>
                     </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white p-8 rounded-xl border border-gray-200 text-center">
                    <p class="text-gray-500 mb-4">Belum ada modul yang tersedia saat ini.</p>
                </div>
            @endif
        </div>

    </div>
</x-app-layout>