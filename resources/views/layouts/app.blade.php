<!DOCTYPE html>
<html lang="es" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', sidebarOpen: true }"
    :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] antialiased transition-colors duration-300">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside x-show="sidebarOpen"
            class="w-64 bg-white dark:bg-[#161615] border-r border-[#e3e3e0] dark:border-[#3E3E3A] flex flex-col shrink-0 transition-all">
            <div class="p-6 font-bold text-xl border-b border-[#e3e3e0] dark:border-[#3E3E3A] dark:text-white">
                Boilerplate
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="/" class="block px-4 py-2 rounded-lg bg-[#dbdbd7] dark:bg-[#3E3E3A] dark:text-white">
                    Inicio
                </a>
                <a href="#"
                    class="block px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-[#3E3E3A] dark:text-[#EDEDEC]">
                    Proyectos
                </a>
                <a href="#"
                    class="block px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-[#3E3E3A] dark:text-[#EDEDEC]">
                    Configuración
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col relative overflow-hidden">
            <!-- Header/Navbar -->
            <header
                class="h-16 bg-white dark:bg-[#161615] border-b border-[#e3e3e0] dark:border-[#3E3E3A] flex items-center justify-between px-8 shrink-0">
                <button @click="sidebarOpen = !sidebarOpen"
                    class="p-2 rounded-md hover:bg-gray-200 dark:hover:bg-[#3E3E3A] transition-colors dark:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>

                <div class="flex items-center gap-6">
                    <div class="flex flex-col items-end">
                        <span class="text-sm font-semibold dark:text-white">Usuario Invitado</span>
                        <span class="text-xs text-[#A1A09A]">Modo Demo</span>
                    </div>

                    <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                        class="p-2 bg-[#dbdbd7] dark:bg-[#3E3E3A] rounded-full w-10 h-10 flex items-center justify-center transition-transform hover:scale-105">
                        <span x-text="darkMode ? '☀️' : '🌙'"></span>
                    </button>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-8 bg-[#FDFDFC] dark:bg-[#0a0a0a]">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>