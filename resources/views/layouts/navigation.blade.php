<nav class="bg-white shadow px-6 py-3 flex justify-between">

    <a href="{{ route('dashboard') }}" class="font-bold">
        Laravel
    </a>

    @auth
    <div class="flex items-center gap-4">

        <span>{{ Auth::user()->name }}</span>

        <a href="{{ route('profile.edit') }}">Perfil</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Salir</button>
        </form>

    </div>
    @endauth

</nav>
