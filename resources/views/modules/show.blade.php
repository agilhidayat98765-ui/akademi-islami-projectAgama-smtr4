<x-app-layout>
    <div class="flex flex-col md:flex-row gap-8 max-w-7xl mx-auto h-full py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="w-full md:w-1/4 bg-white rounded-xl border border-gray-200 p-5 h-fit sticky top-6 shadow-sm">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Daftar Isi</h3>
            <h4 class="font-bold text-gray-900 mb-4">{{ $course->title }}</h4>
            
            <ul class="space-y-2">
                @foreach($course->modules as $mod)
                    @php
                        // Cek apakah materi INI sudah diselesaikan/lulus (Untuk memunculkan centang hijau)
                        $isCompleted = \App\Models\UserProgress::where('user_id', Auth::id())
                                            ->where('module_id', $mod->id)
                                            ->where('is_completed', true)
                                            ->exists();
                    @endphp

                    <li>
                        <a href="{{ route('modules.show', $mod->id) }}" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition-all {{ $module->id == $mod->id ? 'bg-emerald-50 text-emerald-800 font-bold border-l-4 border-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-emerald-700' }}">
                            <span class="truncate pr-2">{{ $mod->order }}. {{ $mod->title }}</span>
                            
                            @if($isCompleted)
                                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="w-full md:w-3/4 bg-white rounded-xl border border-gray-200 p-6 md:p-10 shadow-sm">
            
            <div class="mb-8">
                <span class="inline-block px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-bold mb-3 tracking-wider">MODUL {{ $module->order }}</span>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $module->title }}</h1>
            </div>

            @if($module->video_url)
            <div class="mb-10 aspect-video rounded-xl overflow-hidden shadow-lg border border-gray-100 bg-gray-900">
                <iframe class="w-full h-full" src="{{ $module->video_url }}" title="Video Pembelajaran" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            @endif

            <div class="prose prose-emerald max-w-none text-gray-700 leading-relaxed text-lg mb-6">
                {!! $module->content !!}
            </div>

            <hr class="my-10 border-gray-200">

            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('dashboard') }}" class="w-full sm:w-auto text-center px-5 py-3 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-colors focus:ring-4 focus:ring-gray-100">
                    &larr; Kembali ke Beranda
                </a>
                
                <a href="{{ route('quiz.show', $module->id) }}" class="w-full sm:w-auto text-center px-8 py-3 text-sm font-bold text-white bg-gradient-to-r from-emerald-600 to-emerald-800 rounded-xl shadow-md hover:from-emerald-700 hover:to-emerald-900 transition-all focus:ring-4 focus:ring-emerald-300 flex items-center justify-center gap-2 transform hover:scale-[1.02]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Tandai Selesai & Lanjut Kuis
                </a>
            </div>
            
        </div>
    </div>
</x-app-layout>