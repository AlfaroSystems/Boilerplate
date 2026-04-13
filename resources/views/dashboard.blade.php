<x-app-layout>
    <x-slot name="header">
        Panel Principal
    </x-slot>

    <div class="space-y-8">
        
        <!-- BIENVENIDA -->
        <div class="bg-white dark:bg-[#161615] rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-[#2a2a2a] flex items-center gap-6">
            <div class="w-16 h-16 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    ¡Bienvenido de nuevo, {{ Auth::user()->name }}!
                </h1>
                <p class="text-gray-500 dark:text-gray-400">
                    Aquí tienes un resumen de lo que está sucediendo en el hotel hoy.
                </p>
            </div>
        </div>

        <!-- GRID DE MÉTRICAS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Total Habitaciones -->
            <div class="bg-white dark:bg-[#161615] p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-[#2a2a2a] hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-xl group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-blue-500 bg-blue-50 dark:bg-blue-900/30 px-2 py-1 rounded-full">Hotel</span>
                </div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Habitaciones</h3>
                <p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $totalRooms }}</p>
            </div>

            <!-- Disponibles -->
            <div class="bg-white dark:bg-[#161615] p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-[#2a2a2a] hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 rounded-xl group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-green-500 bg-green-50 dark:bg-green-900/30 px-2 py-1 rounded-full">Libres</span>
                </div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Disponibles</h3>
                <p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $availableRooms }}</p>
            </div>

            <!-- Ocupadas -->
            <div class="bg-white dark:bg-[#161615] p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-[#2a2a2a] hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-xl group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-red-500 bg-red-50 dark:bg-red-900/30 px-2 py-1 rounded-full">Check-in</span>
                </div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Ocupadas</h3>
                <p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $occupiedRooms }}</p>
            </div>

            <!-- Total Clientes -->
            <div class="bg-white dark:bg-[#161615] p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-[#2a2a2a] hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 rounded-xl group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-indigo-500 bg-indigo-50 dark:bg-indigo-900/30 px-2 py-1 rounded-full">Base</span>
                </div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Clientes</h3>
                <p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $totalClients }}</p>
            </div>

        </div>

        <!-- ACCESO RÁPIDO O INFO ADICIONAL -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-xl font-bold mb-2">Resumen de Ocupación</h2>
                    <p class="text-indigo-100 mb-4 text-sm">Estado actual de la capacidad del hotel.</p>
                    <div class="w-full bg-white/20 rounded-full h-4 mb-2">
                        <div class="bg-white h-4 rounded-full" style="width: <?php echo $occupancyRate; ?>%"></div>
                    </div>
                    <p class="text-xs text-white/80">{{ $occupiedRooms }} de {{ $totalRooms }} habitaciones ocupadas</p>
                </div>
                <svg class="absolute right-[-20px] bottom-[-20px] text-white/10 w-48 h-48" fill="currentColor" viewBox="0 0 24 24">
                     <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>

            <div class="bg-white dark:bg-[#161615] rounded-2xl p-6 border border-gray-100 dark:border-[#2a2a2a] shadow-sm">
                <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Acciones Rápidas</h2>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('rooms.create') }}" class="flex items-center gap-2 p-3 bg-gray-50 dark:bg-[#1C1C1B] rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/20 text-gray-700 dark:text-gray-300 transition-colors text-sm font-medium">
                        <span class="text-indigo-500 text-lg">+</span> Nueva Habitación
                    </a>
                    <a href="{{ route('clientes.create') }}" class="flex items-center gap-2 p-3 bg-gray-50 dark:bg-[#1C1C1B] rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/20 text-gray-700 dark:text-gray-300 transition-colors text-sm font-medium">
                        <span class="text-indigo-500 text-lg">+</span> Registrar Cliente
                    </a>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>