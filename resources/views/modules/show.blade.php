<x-app-layout>
    <div class="flex flex-col md:flex-row gap-8 max-w-7xl mx-auto h-full">
        
        <div class="w-full md:w-1/4 bg-white rounded-xl border border-gray-200 p-5 h-fit sticky top-6 shadow-sm">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Daftar Isi</h3>
            <h4 class="font-bold text-gray-900 mb-4">{{ $course->title }}</h4>
            
            <ul class="space-y-2">
                @foreach($course->modules as $mod)
                    <li>
                        <a href="{{ route('modules.show', $mod->id) }}" 
                           class="block px-3 py-2 rounded-lg text-sm transition-colors {{ $module->id == $mod->id ? 'bg-emerald-50 text-emerald-800 font-bold border-l-4 border-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-emerald-700' }}">
                            {{ $mod->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="w-full md:w-3/4 bg-white rounded-xl border border-gray-200 p-6 md:p-10 shadow-sm">
            
            <div class="mb-8">
                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium mb-3">Modul {{ $module->order }}</span>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $module->title }}</h1>
            </div>

            @if($module->video_url)
            <div class="mb-10 aspect-video rounded-xl overflow-hidden shadow-lg border border-gray-100">
                <iframe class="w-full h-full" src="{{ $module->video_url }}" title="Video Pembelajaran" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            @endif

            <div class="prose prose-emerald max-w-none text-gray-700 leading-relaxed text-lg mb-6">
                {!! $module->content !!}
            </div>

            <hr class="my-10 border-gray-200">

            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    &larr; Kembali ke Beranda
                </a>
                
                <a href="{{ route('quiz.show', $module->id) }}" class="px-6 py-2.5 text-sm font-bold text-white bg-emerald-700 rounded-lg shadow-md hover:bg-emerald-800 transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Tandai Selesai & Lanjut Kuis
                </a>
            </div>
            
        </div>
    </div>
</x-app-layout>