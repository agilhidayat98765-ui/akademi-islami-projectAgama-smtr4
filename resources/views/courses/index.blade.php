<x-app-layout>
    <div x-data="{ activeTab: 'dipelajari' }" class="max-w-5xl mx-auto space-y-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Kursus Saya</h1>
            <p class="text-gray-600">Lanjutkan perjalanan belajarmu hari ini.</p>
        </div>

        <div class="flex space-x-6 border-b border-gray-200">
            <button @click="activeTab = 'dipelajari'" :class="activeTab === 'dipelajari' ? 'border-b-2 border-emerald-600 text-emerald-800 font-semibold' : 'text-gray-500 hover:text-gray-700 font-medium'" class="pb-3 transition-colors focus:outline-none">Sedang Dipelajari</button>
            <button @click="activeTab = 'selesai'" :class="activeTab === 'selesai' ? 'border-b-2 border-emerald-600 text-emerald-800 font-semibold' : 'text-gray-500 hover:text-gray-700 font-medium'" class="pb-3 transition-colors focus:outline-none">Selesai</button>
            <button @click="activeTab = 'favorit'" :class="activeTab === 'favorit' ? 'border-b-2 border-emerald-600 text-emerald-800 font-semibold' : 'text-gray-500 hover:text-gray-700 font-medium'" class="pb-3 transition-colors focus:outline-none">Favorit</button>
        </div>

        <div x-show="activeTab === 'dipelajari'" x-cloak>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                @foreach($courses as $course)
                    <div class="relative bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-md hover:border-emerald-400 transition-all group flex flex-col h-full">
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
                        <a href="{{ route('courses.show', $course->slug) }}" class="block flex flex-col h-full">
                            <div class="h-32 bg-gray-200 relative overflow-hidden">
                                <img src="{{ $course->image }}" alt="{{ $course->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                    <span class="text-white font-bold tracking-wider drop-shadow-md">{{ $course->category->name ?? 'Kategori' }}</span>
                                </div>
                             </div>
                            <div class="p-5 flex-1 flex flex-col">
                                <h3 class="text-lg font-bold text-gray-900 mb-4 group-hover:text-emerald-700 transition-colors">{{ $course->title }}</h3>
                                <div class="mt-auto">
                                    <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                        <div class="bg-emerald-600 h-2 rounded-full" style="width: 10%"></div>
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-500 font-medium">Progres 10%</span>
                                        <span class="text-emerald-600 font-bold group-hover:text-emerald-800 transition-colors">Lanjutkan &rarr;</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div x-show="activeTab === 'selesai'" x-cloak>
            <div class="bg-white p-10 rounded-xl border border-gray-200 text-center mt-6 shadow-sm">
                <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Belum Ada Kursus Selesai</h3>
                <p class="text-gray-500">Anda belum menyelesaikan kursus apapun. Terus semangat belajarnya!</p>
            </div>
        </div>

        <div x-show="activeTab === 'favorit'" x-cloak>
            @if($favoriteCourses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    @foreach($favoriteCourses as $course)
                        <div class="relative bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm flex flex-col h-full">
                            <a href="{{ route('courses.show', $course->slug) }}" class="block flex flex-col h-full">
                                <div class="h-32 bg-gray-200 relative overflow-hidden">
                                    <img src="{{ $course->image }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                        <span class="text-white font-bold tracking-wider drop-shadow-md">{{ $course->category->name ?? 'Kategori' }}</span>
                                    </div>
                                </div>
                                <div class="p-5 flex-1 flex flex-col">
                                    <h3 class="text-lg font-bold text-gray-900 mb-4">{{ $course->title }}</h3>
                                    <span class="text-emerald-600 font-bold text-sm mt-auto">Mulai Belajar &rarr;</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white p-10 rounded-xl border border-gray-200 text-center mt-6 shadow-sm">
                    <div class="w-16 h-16 bg-red-50 text-red-400 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Belum Ada Kursus Favorit</h3>
                    <p class="text-gray-500">Klik ikon hati pada modul untuk menyimpannya ke daftar ini.</p>
                </div>
            @endif
        </div>

    </div>
</x-app-layout>