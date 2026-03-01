<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-input name="email" type="email" label="Correo Electrónico" :value="old('email', $request->email)" required
            autofocus autocomplete="username" />
        <x-input name="password" type="password" label="Nueva Contraseña" required autocomplete="new-password" />

        <x-input name="password_confirmation" type="password" label="Confirmar Contraseña" required
            autocomplete="new-password" />

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                Restablecer Contraseña
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>