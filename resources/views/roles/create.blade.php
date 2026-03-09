<x-app-layout>
    <x-slot name="header">
        Nuevo Rol
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <x-card>
            <x-slot name="header">
                Registrar un Nuevo Rol de Sistema
            </x-slot>

            <form action="{{ route('roles.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="space-y-6">
                    <!-- Nombre del Rol -->
                    <x-input name="name" label="Nombre del Rol" value="{{ old('name') }}" required autofocus placeholder="Ej. Editor de Contenido" />

                    <!-- Permisos -->
                    <div class="space-y-3">
                        <label class="text-sm font-bold text-gray-700 dark:text-[#EDEDEC] uppercase tracking-wider">Asignar Permisos</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($permissions as $permission)
                                <div class="flex items-center gap-3 p-3 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] hover:bg-gray-50 dark:hover:bg-[#1C1C1B] transition-colors">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm_{{ $permission->id }}" 
                                        {{ is_array(old('permissions')) && in_array($permission->id, old('permissions')) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <label for="perm_{{ $permission->id }}" class="text-sm font-medium text-gray-700 dark:text-[#A1A09A] cursor-pointer">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('permissions')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <a href="{{ route('roles.index') }}"
                        class="px-4 py-2 text-sm font-semibold text-gray-600 dark:text-[#A1A09A] hover:underline">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition-colors shadow-lg shadow-indigo-500/20">
                        Guardar Rol
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
