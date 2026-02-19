<x-app-layout>
    <x-slot name="header">
        Panel Principal
    </x-slot>

    <div class="space-y-6">
        <x-card>
            <x-slot name="header">
                ¡Bienvenido, {{ Auth::user()->name }}!
            </x-slot>

            <p class="text-lg">
                Has iniciado sesión correctamente. Los componentes de autenticación han sido integrados con el sistema
                de diseño premium del **Dev 2**.
            </p>
        </x-card>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-card>
                <x-slot name="header">Estado de la Tarea</x-slot>
                <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">DEV 3</p>
                <p class="text-sm text-[#A1A09A]">Autenticación Completada</p>
            </x-card>

            <x-card>
                <x-slot name="header">Usuario Actual</x-slot>
                <p class="font-semibold dark:text-white">{{ Auth::user()->email }}</p>
                <p class="text-sm text-[#A1A09A]">ID: {{ Auth::id() }}</p>
            </x-card>

            <x-card>
                <x-slot name="header">Siguiente Paso</x-slot>
                <span
                    class="px-2 py-1 bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 rounded-md text-sm font-medium">
                    Dev 4: RBAC
                </span>
            </x-card>
        </div>
    </div>
</x-app-layout>