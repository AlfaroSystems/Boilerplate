<x-app-layout>
    <x-slot name="header">
        Roles y Permisos del Sistema
    </x-slot>

    <div class="space-y-6">
        <!-- Tarjetas de Roles -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($roles as $role)
                <x-card>
                    <x-slot name="header">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-gray-900 dark:text-white">{{ $role->name }}</span>
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300">
                                {{ $role->permissions->count() }} Permisos
                            </span>
                        </div>
                    </x-slot>

                    <div class="p-4 space-y-4">
                        <div class="flex flex-wrap gap-2">
                            @forelse ($role->permissions as $permission)
                                <span
                                    class="px-2 py-1 text-xs font-medium rounded-md bg-gray-100 text-gray-600 dark:bg-[#1C1C1B] dark:text-[#A1A09A] border border-[#e3e3e0] dark:border-[#3E3E3A]">
                                    {{ $permission->name }}
                                </span>
                            @empty
                                <span class="text-sm text-gray-500 italic">No tiene permisos asignados</span>
                            @endforelse
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>

        <!-- Información Adicional -->
        <div class="mt-8 p-6 bg-blue-50 dark:bg-blue-900/10 rounded-xl border border-blue-100 dark:border-blue-900/30">
            <div class="flex gap-4">
                <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg text-blue-600 dark:text-blue-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-blue-900 dark:text-blue-300">Gestión de Acceso</h4>
                    <p class="text-sm text-blue-800 dark:text-blue-400 opacity-80 mt-1">
                        Los roles definen qué acciones pueden realizar los usuarios dentro del sistema. Actualmente esta
                        vista es solo de consulta de permisos asignados por base de datos.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>