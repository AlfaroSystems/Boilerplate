<x-app-layout>
    <x-slot name="header">
        Mi Perfil: {{ $user->name }}
    </x-slot>

    <div class="max-w-4xl mx-auto">
        @if (session('status'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        <x-card>
            <x-slot name="header">
                Modificar Mis Datos
            </x-slot>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
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
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition-colors shadow-lg shadow-indigo-500/20">
                        Actualizar Perfil
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
