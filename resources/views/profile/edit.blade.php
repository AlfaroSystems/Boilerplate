<x-app-layout>
    <x-slot name="header">
        Configuración de Perfil
    </x-slot>

    <div class="max-w-4xl space-y-8">
        <x-card>
            <x-slot name="header">Información del Perfil</x-slot>
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </x-card>

        <x-card>
            <x-slot name="header">Actualizar Contraseña</x-slot>
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </x-card>

        <x-card>
            <x-slot name="header">Eliminar Cuenta</x-slot>
            <div class="max-w-xl text-red-600">
                @include('profile.partials.delete-user-form')
            </div>
        </x-card>
    </div>
</x-app-layout>