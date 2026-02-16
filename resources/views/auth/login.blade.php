<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <x-input name="email" type="email" label="Correo Electrónico" :value="old('email')" required autofocus
            autocomplete="username" />

        <x-input name="password" type="password" label="Contraseña" required autocomplete="current-password" />

        <div class="flex items-center justify-between mt-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded dark:bg-[#0a0a0a] border-[#e3e3e0] dark:border-[#3E3E3A] text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ms-2 text-sm text-gray-600 dark:text-[#A1A09A]">Recordarme</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline"
                    href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        <div class="pt-4">
            <x-primary-button class="w-full justify-center py-3 text-lg">
                Iniciar Sesión
            </x-primary-button>
        </div>

        <p class="text-center text-sm text-gray-600 dark:text-[#A1A09A] mt-8">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}"
                class="text-indigo-600 dark:text-indigo-400 font-bold hover:underline">Regístrate</a>
        </p>
    </form>
</x-guest-layout>