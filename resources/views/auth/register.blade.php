<x-guest-layout>
    <div
        class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] shadow-md overflow-hidden sm:rounded-2xl">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">Crear Cuenta</h2>
            <p class="text-sm text-gray-600 dark:text-[#A1A09A]">Únete a nuestro laboratorio</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <x-input name="name" label="Nombre Completo" :value="old('name')" required autofocus />

            <x-input name="email" type="email" label="Correo Electrónico" :value="old('email')" required />

            <x-input name="password" type="password" label="Contraseña" required />

            <x-input name="password_confirmation" type="password" label="Confirmar Contraseña" required />

            <div class="pt-6">
                <x-primary-button class="w-full justify-center py-3 text-lg">Registrarse</x-primary-button>
            </div>

            <p class="text-center text-sm text-gray-600 dark:text-[#A1A09A] mt-8">
                ¿Ya tienes cuenta? <a href="{{ route('login') }}"
                    class="text-indigo-600 dark:text-indigo-400 font-bold hover:underline">Inicia Sesión</a>
            </p>
        </form>
    </div>
</x-guest-layout>