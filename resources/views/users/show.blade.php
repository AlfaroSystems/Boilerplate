<x-app-layout>
    <x-slot name="header">
        Detalles del Usuario: {{ $user->name }}
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <x-card>
            <x-slot name="header">
                Información del Perfil
            </x-slot>

            <div class="space-y-8 p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Datos Personales -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">
                            Datos Personales</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500 dark:text-[#6E6E6A]">Nombre Completo</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}
                                    {{ $user->last_name }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-[#6E6E6A]">Correo Electrónico</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->email }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-[#6E6E6A]">Teléfono</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $user->phone ?? 'No especificado' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Datos de Cuenta -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">
                            Datos de Cuenta</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500 dark:text-[#6E6E6A]">Rol del Usuario</p>
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                    {{ $user->role }}
                                </span>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-[#6E6E6A]">Estado Actual</p>
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full {{ $user->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-[#6E6E6A]">Fecha de Registro</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $user->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-[#6E6E6A]">Último Inicio de Sesión</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Nunca ha ingresado' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <a href="{{ route('users.index') }}"
                        class="flex items-center gap-2 text-sm font-semibold text-gray-600 dark:text-[#A1A09A] hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Volver a la Lista
                    </a>

                    <a href="{{ route('users.edit', $user) }}"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition-colors shadow-lg shadow-indigo-500/20 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Ir a Editar
                    </a>
                </div>
            </div>
        </x-card>
    </div>
</x-app-layout>