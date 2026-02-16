<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <x-input name="current_password" type="password" label="Contraseña Actual" autocomplete="current-password" />

        <x-input name="password" type="password" label="Nueva Contraseña" autocomplete="new-password" />

        <x-input name="password_confirmation" type="password" label="Confirmar Nueva Contraseña"
            autocomplete="new-password" />

        <div class="flex items-center gap-4 pt-4">
            <x-primary-button>Actualizar Contraseña</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">
                    Contraseña actualizada.
                </p>
            @endif
        </div>
    </form>
</section>