<x-app-layout>
    <div class="max-w-3xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Evaluasi: {{ $module->title }}</h1>
            <a href="{{ route('modules.show', $module->id) }}" class="text-sm font-medium text-red-600 hover:text-red-800 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                Keluar Kuis
            </a>
        </div>

        <div x-data="{ step: 1, totalSteps: {{ $questions->count() }} }" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            
            <div class="bg-gray-100 h-2 w-full">
                <div class="bg-emerald-600 h-2 transition-all duration-300" :style="'width: ' + ((step / totalSteps) * 100) + '%'"></div>
            </div>

            <div class="p-8">
                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('quiz.submit', $module->id) }}" method="POST">
                    @csrf
                    
                    @foreach($questions as $index => $question)
                    <div x-show="step === {{ $index + 1 }}" x-cloak>
                        <p class="text-sm text-gray-500 font-bold tracking-widest uppercase mb-4">Pertanyaan {{ $index + 1 }} dari {{ $questions->count() }}</p>
                        <h2 class="text-xl text-gray-900 font-semibold mb-6 leading-relaxed">{{ $question->question_text }}</h2>
                        
                        <div class="space-y-3">
                            @foreach(['a' => $question->option_a, 'b' => $question->option_b, 'c' => $question->option_c, 'd' => $question->option_d] as $key => $option)
                            <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-emerald-50 hover:border-emerald-500 transition-colors">
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $key }}" class="w-5 h-5 text-emerald-600 border-gray-300 focus:ring-emerald-500" required>
                                <span class="ml-4 text-gray-700">{{ $option }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                    <div class="mt-10 flex justify-between items-center pt-6 border-t border-gray-100">
                        <button type="button" x-show="step > 1" @click="step--" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            &larr; Sebelumnya
                        </button>
                        <div x-show="step === 1"></div> <button type="button" x-show="step < totalSteps" @click="step++" class="px-6 py-2.5 text-sm font-bold text-white bg-emerald-700 rounded-lg shadow-md hover:bg-emerald-800 transition">
                            Berikutnya &rarr;
                        </button>

                        <button type="submit" x-show="step === totalSteps" class="px-6 py-2.5 text-sm font-bold text-white bg-emerald-700 rounded-lg shadow-md hover:bg-emerald-800 transition">
                            Kirim Jawaban
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>