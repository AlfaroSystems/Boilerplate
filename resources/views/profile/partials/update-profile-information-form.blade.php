<section>
    <header class="mb-6">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
            Información del Perfil
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-[#A1A09A]">
            Actualiza la información de tu cuenta y tu dirección de correo electrónico.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <x-input name="name" label="Nombre" :value="old('name', $user->name)" required autofocus autocomplete="name" />

        <x-input name="email" type="email" label="Correo Electrónico" :value="old('email', $user->email)" required
            autocomplete="username" />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
            <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                <p class="text-sm text-yellow-700 dark:text-yellow-400">
                    Tu dirección de correo no ha sido verificada.
                    <button form="send-verification"
                        class="font-bold underline hover:text-yellow-800 dark:hover:text-yellow-300">
                        Haz clic aquí para reenviar el correo de verificación.
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        Se ha enviado un nuevo enlace de verificación a tu correo.
                    </p>
                @endif
            </div>
        @endif

        <div class="flex items-center gap-4 pt-4">
            <x-primary-button>Guardar</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400 font-medium">
                    Guardado.
                </p>
            @endif
        </div>
    </form>
</section>