<x-app-layout>
    <x-slot name="header">
        Nuevo Usuario
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <x-card>
            <x-slot name="header">
                Registrar un Nuevo Usuario Administrativo
            </x-slot>

            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nombre -->
                    <x-input name="name" label="Nombre" value="{{ old('name') }}" required autofocus />

                    <!-- Apellidos -->
                    <x-input name="last_name" label="Apellidos" value="{{ old('last_name') }}" />

                    <!-- Correo Electrónico -->
                    <x-input name="email" type="email" label="Correo Electrónico" value="{{ old('email') }}" required />

                    <!-- Teléfono -->
                    <x-input name="phone" label="Teléfono" value="{{ old('phone') }}" />

                    <!-- Rol -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700 dark:text-[#EDEDEC]" for="role">Rol del
                            Usuario</label>
                        <select name="role" id="role"
                            class="w-full rounded-lg bg-gray-50 border border-[#e3e3e0] dark:bg-[#161615] dark:border-[#3E3E3A] dark:text-white p-2 text-sm">
                            <option value="Usuario" {{ old('role') == 'Usuario' ? 'selected' : '' }}>Usuario General
                            </option>
                            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Administrador</option>
                            <option value="Editor" {{ old('role') == 'Editor' ? 'selected' : '' }}>Editor</option>
                        </select>
                    </div>

                    <!-- Estado -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700 dark:text-[#EDEDEC]" for="status">Estado de
                            Cuenta</label>
                        <select name="status" id="status"
                            class="w-full rounded-lg bg-gray-50 border border-[#e3e3e0] dark:bg-[#161615] dark:border-[#3E3E3A] dark:text-white p-2 text-sm">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Activo</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <!-- Contraseña -->
                    <x-input name="password" type="password" label="Contraseña" required />

                    <!-- Confirmar Contraseña -->
                    <x-input name="password_confirmation" type="password" label="Confirmar Contraseña" required />
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <a href="{{ route('users.index') }}"
                        class="px-4 py-2 text-sm font-semibold text-gray-600 dark:text-[#A1A09A] hover:underline">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition-colors shadow-lg shadow-indigo-500/20">
                        Guardar Usuario
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>