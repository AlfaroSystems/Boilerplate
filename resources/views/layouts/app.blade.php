<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', sidebarOpen: true }" :class="{ 'dark': darkMode }">

<head>
    <script>
        if (localStorage.getItem('darkMode') === 'true' ||
            (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] antialiased transition-colors duration-300">
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside x-show="sidebarOpen"
            class="w-64 bg-white dark:bg-[#161615] border-r border-[#e3e3e0] dark:border-[#3E3E3A] flex flex-col shrink-0 transition-all z-20">

            <div
                class="h-16 flex items-center px-6 font-bold text-xl border-b border-[#e3e3e0] dark:border-[#3E3E3A] dark:text-white uppercase tracking-wider">
                Boilerplate
            </div>

            <nav class="flex-1 p-4 space-y-2">

                <!-- Inicio -->
                <a href="{{ route('dashboard') }}"
                    class="block px-4 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-[#dbdbd7] dark:bg-[#3E3E3A] dark:text-white' : 'hover:bg-gray-100 dark:hover:bg-[#3E3E3A] dark:text-[#EDEDEC]' }}">
                    Inicio
                </a>

                <!-- Perfil -->
                @can('editar-perfil')
                    <a href="{{ route('profile.edit') }}"
                        class="block px-4 py-2 rounded-lg {{ request()->routeIs('profile.edit') ? 'bg-[#dbdbd7] dark:bg-[#3E3E3A] dark:text-white' : 'hover:bg-gray-100 dark:hover:bg-[#3E3E3A] dark:text-[#EDEDEC]' }}">
                        Mi Perfil
                    </a>
                @endcan

                <!-- Usuarios -->
                @can('gestionar-usuarios')
                    <a href="{{ route('users.index') }}"
                        class="block px-4 py-2 rounded-lg {{ request()->routeIs('users.*') ? 'bg-[#dbdbd7] dark:bg-[#3E3E3A] dark:text-white' : 'hover:bg-gray-100 dark:hover:bg-[#3E3E3A] dark:text-[#EDEDEC]' }}">
                        Usuarios
                    </a>
                @endcan

                <!-- Roles -->
                @can('gestionar-roles')
                    <a href="{{ route('roles.index') }}"
                        class="block px-4 py-2 rounded-lg {{ request()->routeIs('roles.*') ? 'bg-[#dbdbd7] dark:bg-[#3E3E3A] dark:text-white' : 'hover:bg-gray-100 dark:hover:bg-[#3E3E3A] dark:text-[#EDEDEC]' }}">
                        Roles y Permisos
                    </a>
                @endcan

                <!-- Clientes -->
                @can('gestionar-clientes')
                    <a href="{{ route('clientes.index') }}"
                        class="block px-4 py-2 rounded-lg {{ request()->routeIs('clientes.*') ? 'bg-[#dbdbd7] dark:bg-[#3E3E3A] dark:text-white' : 'hover:bg-gray-100 dark:hover:bg-[#3E3E3A] dark:text-[#EDEDEC]' }}">
                        Clientes
                    </a>
                @endcan

                <!-- Habitaciones -->
                @can('gestionar-habitaciones')
                    <a href="{{ route('rooms.index') }}"
                        class="block px-4 py-2 rounded-lg {{ request()->routeIs('rooms.*') ? 'bg-[#dbdbd7] dark:bg-[#3E3E3A] dark:text-white' : 'hover:bg-gray-100 dark:hover:bg-[#3E3E3A] dark:text-[#EDEDEC]' }}">
                        Gestión de Habitaciones
                    </a>
                @endcan

            </nav>
        </aside>

        <!-- CONTENIDO -->
        <div class="flex-1 flex flex-col relative overflow-hidden">

            <!-- HEADER -->
            <header
                class="h-16 bg-white/80 dark:bg-[#161615]/80 backdrop-blur-md border-b border-[#e3e3e0] dark:border-[#3E3E3A] flex items-center justify-between px-6 shrink-0 z-10 sticky top-0">

                <button @click="sidebarOpen = !sidebarOpen"
                    class="p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-[#3E3E3A] transition-all dark:text-white group">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-16 6h16"></path>
                    </svg>
                </button>

                <div class="flex items-center gap-4">

                    <!-- Usuario -->
                    <div class="flex items-center gap-3 pr-4 border-r border-[#e3e3e0] dark:border-[#3E3E3A]">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-gray-900 dark:text-white leading-none">
                                {{ Auth::user()->name }}
                            </p>

                            @auth
                                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                                    @csrf
                                    <button type="submit"
                                        class="text-[10px] uppercase tracking-tighter font-bold text-red-500 hover:text-red-600 transition-colors">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            @endauth
                        </div>

                        <div
                            class="w-8 h-8 rounded-full bg-indigo-50 border border-indigo-100 dark:bg-indigo-900/20 dark:border-indigo-800 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-xs">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>

                    <!-- Dark mode -->
                    <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                        class="p-2.5 bg-gray-50 dark:bg-[#1C1C1B] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl transition-all hover:bg-white dark:hover:bg-[#252524] hover:shadow-sm">
                        <span x-show="!darkMode" class="text-lg">🌙</span>
                        <span x-show="darkMode" class="text-lg">☀️</span>
                    </button>
                </div>
            </header>

            <!-- MAIN -->
            <main class="flex-1 overflow-y-auto p-8 bg-[#FDFDFC] dark:bg-[#0a0a0a]">

                @if (isset($header))
                    <div class="mb-8">
                        <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight">
                            {{ $header }}
                        </h2>
                    </div>
                @endif

                <!-- ALERTAS GLOBAL -->
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                        class="mb-6 flex items-center p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl text-green-700 dark:text-green-300 shadow-sm transition-all">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                        class="mb-6 flex items-center p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl text-red-700 dark:text-red-300 shadow-sm transition-all">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                {{ $slot ?? '' }}
                @yield('content')

            </main>
        </div>
    </div>
</body>

</html>