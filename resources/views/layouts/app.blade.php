<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', sidebarOpen: true }" :class="{ 'dark': darkMode }">

<head>
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
            class="w-64 bg-white dark:bg-[#161615] border-r border-[#e3e3e0] dark:border-[#3E3E3A] flex flex-col shrink-0 transition-all">
            <div class="p-6 font-bold text-xl border-b border-[#e3e3e0] dark:border-[#3E3E3A] dark:text-white">
                Boilerplate
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('dashboard') }}"
                    class="block px-4 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-[#dbdbd7] dark:bg-[#3E3E3A] dark:text-white' : 'hover:bg-gray-100 dark:hover:bg-[#3E3E3A] dark:text-[#EDEDEC]' }}">
                    Inicio
                </a>
                <a href="{{ route('users.index') }}"
                    class="block px-4 py-2 rounded-lg {{ request()->routeIs('users.index') ? 'bg-[#dbdbd7] dark:bg-[#3E3E3A] dark:text-white' : 'hover:bg-gray-100 dark:hover:bg-[#3E3E3A] dark:text-[#EDEDEC]' }}">
                    Usuarios
                </a>
                <a href="{{ route('roles.index') }}"
                    class="block px-4 py-2 rounded-lg {{ request()->routeIs('roles.index') ? 'bg-[#dbdbd7] dark:bg-[#3E3E3A] dark:text-white' : 'hover:bg-gray-100 dark:hover:bg-[#3E3E3A] dark:text-[#EDEDEC]' }}">
                    Roles y Permisos
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
                        @auth
                            <span class="text-sm font-semibold dark:text-white">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-xs text-red-500 hover:underline">Cerrar Sesión</button>
                            </form>
                        @else
                            <span class="text-sm font-semibold dark:text-white">Invitado</span>
                            <div class="flex gap-2">
                                <a href="{{ route('login') }}" class="text-xs text-indigo-500 hover:underline">Login</a>
                                <a href="{{ route('register') }}"
                                    class="text-xs text-indigo-500 hover:underline">Registro</a>
                            </div>
                        @endauth
                    </div>

                    <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                        class="p-2 bg-[#dbdbd7] dark:bg-[#3E3E3A] rounded-full w-10 h-10 flex items-center justify-center transition-transform hover:scale-105">
                        <span x-text="darkMode ? '☀️' : '🌙'"></span>
                    </button>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-8 bg-[#FDFDFC] dark:bg-[#0a0a0a]">
                @if (isset($header))
                    <div class="mb-8">
                        <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight">
                            {{ $header }}
                        </h2>
                    </div>
                @endif
                {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>