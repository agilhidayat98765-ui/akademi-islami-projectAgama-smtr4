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
    </body>
</html>