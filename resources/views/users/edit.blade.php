<x-app-layout>
    <x-slot name="header">
        Editar Usuario: {{ $user->name }}
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <x-card>
            <x-slot name="header">
                Modificar Datos del Usuario
            </x-slot>

            <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nombre -->
                    <x-input name="name" label="Nombre" value="{{ old('name', $user->name) }}" required autofocus />

                    <!-- Apellidos -->
                    <x-input name="last_name" label="Apellidos" value="{{ old('last_name', $user->last_name) }}" />

                    <!-- Correo Electrónico -->
                    <x-input name="email" type="email" label="Correo Electrónico"
                        value="{{ old('email', $user->email) }}" required />

                    <!-- Teléfono -->
                    <x-input name="phone" label="Teléfono" value="{{ old('phone', $user->phone) }}" />

                    <!-- Rol -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700 dark:text-[#EDEDEC]" for="role">Rol del
                            Usuario</label>
                        <select name="role" id="role"
                            class="w-full rounded-lg bg-gray-50 border border-[#e3e3e0] dark:bg-[#161615] dark:border-[#3E3E3A] dark:text-white p-2 text-sm">
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ old('role', $user->roles->first()?->name) == $role->name ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Estado -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700 dark:text-[#EDEDEC]" for="status">Estado de
                            Cuenta</label>
                        <select name="status" id="status"
                            class="w-full rounded-lg bg-gray-50 border border-[#e3e3e0] dark:bg-[#161615] dark:border-[#3E3E3A] dark:text-white p-2 text-sm">
                            <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Activo
                            </option>
                            <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>
                                Inactivo</option>
                        </select>
                    </div>

                    <!-- Contraseña (Opcional) -->
                    <div
                        class="col-span-1 md:col-span-2 space-y-4 pt-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                        <p class="text-xs text-[#A1A09A]">Deja la contraseña en blanco si no deseas cambiarla.</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-input name="password" type="password" label="Nueva Contraseña" />
                            <x-input name="password_confirmation" type="password" label="Confirmar Nueva Contraseña" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <a href="{{ route('users.index') }}"
                        class="px-4 py-2 text-sm font-semibold text-gray-600 dark:text-[#A1A09A] hover:underline">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition-colors shadow-lg shadow-indigo-500/20">
                        Actualizar Usuario
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>