<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <x-input name="name" label="Nombre Completo" :value="old('name')" required autofocus autocomplete="name" />

        <x-input name="email" type="email" label="Correo Electrónico" :value="old('email')" required
            autocomplete="username" />

        <x-input name="password" type="password" label="Contraseña" required autocomplete="new-password" />

        <x-input name="password_confirmation" type="password" label="Confirmar Contraseña" required
            autocomplete="new-password" />

        <div class="pt-6">
            <x-primary-button class="w-full justify-center py-3 text-lg">
                Crear Cuenta
            </x-primary-button>
        </div>

        <p class="text-center text-sm text-gray-600 dark:text-[#A1A09A] mt-8">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" class="text-indigo-600 dark:text-indigo-400 font-bold hover:underline">Inicia
                Sesión</a>
        </p>
    </form>
</x-guest-layout>