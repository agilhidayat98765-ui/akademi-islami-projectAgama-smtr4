<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Akademi Islami</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50" style="font-family: 'Plus Jakarta Sans', sans-serif;">
        <div x-data="{ sidebarOpen: true }" class="flex min-h-screen">
            
            <aside x-show="sidebarOpen" x-transition class="w-64 bg-white border-r border-gray-200 flex flex-col transition-all duration-300">
                <div class="h-16 flex items-center px-6 border-b border-gray-100">
                    <span class="text-xl font-bold text-emerald-800">✨ Akademi Islami</span>
                </div>
                
                <nav class="flex-1 px-4 py-6 space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-emerald-50 hover:text-emerald-800 rounded-lg transition-colors">
                        <span class="font-medium">Beranda</span>
                    </a>
                    <a href="{{ route('courses.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-emerald-50 hover:text-emerald-800 rounded-lg transition-colors">
                        <span class="font-medium">Kursus Saya</span>
                    </a>
                    <a href="{{ route('rapor.index') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-emerald-50 hover:text-emerald-800 rounded-lg transition-colors">
                        <span class="font-medium">Rapor Saya</span>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-emerald-50 hover:text-emerald-800 rounded-lg transition-colors">
                        <span class="font-medium">Pengaturan Akun</span>
                    </a>
                    
                </nav>
            </aside>

            <div class="flex-1 flex flex-col min-w-0">
                <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-md text-gray-500 hover:bg-gray-100 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-gray-500 hover:text-red-600">
                                Keluar
                            </button>
                        </form>
                    </div>
                </header>

                <main class="p-6 md:p-8 flex-1 overflow-y-auto">
                    {{ $slot }}
                </main>
            </div>
        </div>
        <div x-data="chatbot()" class="fixed bottom-6 right-6 z-50">
            
            <div x-show="open" x-transition class="bg-white w-80 sm:w-96 rounded-xl shadow-2xl border border-gray-200 mb-4 flex flex-col overflow-hidden" style="height: 450px; display: none;">
                
                <div class="bg-emerald-700 text-white p-4 flex justify-between items-center shadow-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-6 h-6 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        <span class="font-bold">AI Tutor Terpadu</span>
                    </div>
                    <button @click="open = false" class="text-white hover:text-emerald-200 transition-colors focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="flex-1 p-4 overflow-y-auto bg-gray-50 space-y-4" id="chat-messages">
                    <template x-for="(msg, index) in messages" :key="index">
                        <div :class="msg.role === 'user' ? 'text-right' : 'text-left'">
                            <span :class="msg.role === 'user' ? 'bg-emerald-600 text-white rounded-br-sm' : 'bg-white border border-gray-200 text-gray-800 rounded-bl-sm'" 
                                  class="inline-block px-4 py-2 rounded-2xl text-sm max-w-[85%] shadow-sm prose prose-sm prose-emerald leading-relaxed" 
                                  x-html="msg.text.replace(/\n/g, '<br>')">
                            </span>
                        </div>
                    </template>
                    
                    <div x-show="loading" class="text-left">
                        <span class="inline-block px-4 py-2 rounded-2xl rounded-bl-sm text-sm bg-white border border-gray-200 text-gray-400 font-medium shadow-sm animate-pulse">
                            AI sedang berpikir...
                        </span>
                    </div>
                </div>

                <div class="p-3 border-t border-gray-200 bg-white">
                    <form @submit.prevent="sendMessage" class="flex gap-2 relative">
                        <input type="text" x-model="newMessage" placeholder="Tanya apa saja ke AI..." class="w-full border border-gray-300 rounded-full pl-4 pr-12 py-2.5 text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all shadow-inner" required :disabled="loading">
                        <button type="submit" class="absolute right-1 top-1 bottom-1 bg-emerald-600 text-white p-2 rounded-full hover:bg-emerald-700 transition-colors focus:outline-none" :disabled="loading">
                            <svg class="w-4 h-4 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

            <button @click="open = !open" class="bg-emerald-700 text-white w-14 h-14 rounded-full shadow-xl flex items-center justify-center hover:bg-emerald-800 hover:scale-105 transition-all focus:outline-none ml-auto border-2 border-white">
                <svg x-show="!open" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                <svg x-show="open" x-cloak class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('chatbot', () => ({
                open: false,
                newMessage: '',
                loading: false,
                messages: [{ role: 'bot', text: 'Assalamu\'alaikum! Aku adalah AI Tutor serba tahu. Ada pertanyaan seputar materi atau hal lainnya yang ingin kamu diskusikan hari ini?' }],
                async sendMessage() {
                    if (!this.newMessage.trim()) return;
                    
                    let userText = this.newMessage;
                    this.messages.push({ role: 'user', text: userText });
                    this.newMessage = '';
                    this.loading = true;
                    this.scrollToBottom();

                    try {
                        let response = await fetch('/chat', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ message: userText })
                        });
                        
                        if(response.ok) {
                            let data = await response.json();
                            this.messages.push({ role: 'bot', text: data.reply });
                        } else {
                            // BAGIAN INI KITA UBAH UNTUK MEMBONGKAR ERROR DARI SERVER
                            let errorHtml = await response.text();
                            this.messages.push({ role: 'bot', text: 'HTTP Status ' + response.status + ' | Detail Server: ' + errorHtml.substring(0, 150) });
                        }
                    } catch (e) {
                        this.messages.push({ role: 'bot', text: 'Sistem JavaScript Error: ' + e.message });
                    }
                    
                    this.loading = false;
                    this.scrollToBottom();
                },
                scrollToBottom() {
                    setTimeout(() => {
                        let chatBox = document.getElementById('chat-messages');
                        chatBox.scrollTop = chatBox.scrollHeight;
                    }, 50);
                }
            }))
        })
        </script>
    </body>
</html>