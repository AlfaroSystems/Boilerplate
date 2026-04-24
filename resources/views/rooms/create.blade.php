@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">

    <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">
        Registrar Habitación
    </h1>

    <!-- ERRORES -->
    @if ($errors->any())
        <div class="bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- CARD -->
    <div class="bg-white dark:bg-[#161615] p-6 rounded-xl shadow">

        <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Número -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Número de habitación
                </label>
                <input type="text" name="room_number" value="{{ old('room_number') }}" required
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
            </div>

            <!-- Tipo -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Tipo
                </label>
                <select name="type" required
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                    <option value="individual" {{ old('type') == 'individual' ? 'selected' : '' }}>Individual</option>
                    <option value="familiar" {{ old('type') == 'familiar' ? 'selected' : '' }}>Familiar</option>
                    <option value="suite" {{ old('type') == 'suite' ? 'selected' : '' }}>Suite</option>
                </select>
            </div>

            <!-- Precio -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Precio Base por noche
                </label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}" required
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
            </div>

            <!-- Descripción (Contenido) -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    ¿Qué contiene la habitación? (Camas, baño, etc.)
                </label>
                <textarea name="description" rows="3"
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">{{ old('description') }}</textarea>
            </div>

            <!-- Fotografía -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Fotografías de la habitación (Puedes seleccionar varias)
                </label>
                <input type="file" name="images[]" accept="image/*" multiple
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
            </div>

            <!-- BOTONES -->
            <div class="flex justify-between mt-6">
                <a href="{{ route('rooms.index') }}"
                    class="px-4 py-2 bg-gray-300 dark:bg-[#2a2a2a] dark:text-white rounded hover:bg-gray-400 dark:hover:bg-[#3a3a3a] transition">
                    Volver
                </a>

                <button
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded shadow transition flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Registrar Habitación
                </button>
            </div>

        </form>
    </div>
</div>

@endsection