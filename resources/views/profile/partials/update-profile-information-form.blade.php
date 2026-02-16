<section>
    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <x-input name="name" label="Nombre Completo" :value="old('name', $user->name)" required autofocus
            autocomplete="name" />

        <x-input name="email" type="email" label="Correo Electrónico" :value="old('email', $user->email)" required
            autocomplete="username" />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
            <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                <p class="text-sm text-yellow-700 dark:text-yellow-400">
                    Tu correo no ha sido verificado.
                    <button form="send-verification" class="font-bold underline">Reenviar verificación</button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm text-green-600">Link enviado!</p>
                @endif
            </div>
        @endif

        <div class="flex items-center gap-4 pt-4">
            <x-primary-button>Guardar Cambios</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">
                    Guardado correctamente.
                </p>
            @endif
        </div>
    </form>
</section>