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

        <form action="{{ route('rooms.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Número de habitación
                </label>
                <input type="text" name="room_number"
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
            </div>

            <!-- Tipo -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Tipo
                </label>
                <select name="type"
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
                    <option value="individual">Individual</option>
                    <option value="familiar">Familiar</option>
                    <option value="suite">Suite</option>
                </select>
            </div>

            <!-- Precio -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Precio por noche
                </label>
                <input type="number" step="0.01" name="price"
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
            </div>

            <!-- Estado -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Estado
                </label>
                <select name="status"
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
                    <option value="disponible">Disponible</option>
                    <option value="ocupada">Ocupada</option>
                    <option value="mantenimiento">Mantenimiento</option>
                </select>
            </div>

            <!-- Fecha -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Disponible desde
                </label>
                <input type="date" name="available_from"
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
            </div>

            <!-- BOTONES -->
            <div class="flex justify-between mt-6">
                <a href="{{ route('rooms.index') }}"
                    class="px-4 py-2 bg-gray-300 dark:bg-[#2a2a2a] dark:text-white rounded">
                    Volver
                </a>

                <button
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded shadow">
                    Guardar
                </button>
            </div>

        </form>
    </div>
</div>

@endsection