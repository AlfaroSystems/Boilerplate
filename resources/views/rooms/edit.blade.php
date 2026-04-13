@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">

    <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">
        Editar Habitación: {{ $room->room_number }}
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

        <form action="{{ route('rooms.update', $room) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Número de habitación
                </label>
                <input type="text" name="room_number" value="{{ old('room_number', $room->room_number) }}"
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
            </div>

            <!-- Tipo -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Tipo
                </label>
                <select name="type"
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                    <option value="individual" {{ old('type', $room->type) == 'individual' ? 'selected' : '' }}>Individual</option>
                    <option value="familiar" {{ old('type', $room->type) == 'familiar' ? 'selected' : '' }}>Familiar</option>
                    <option value="suite" {{ old('type', $room->type) == 'suite' ? 'selected' : '' }}>Suite</option>
                </select>
            </div>

            <!-- Precio -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Precio por noche
                </label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $room->price) }}"
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
            </div>

            <!-- Estado -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Estado
                </label>
                <select name="status"
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                    <option value="disponible" {{ old('status', $room->status) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="ocupada" {{ old('status', $room->status) == 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                    <option value="mantenimiento" {{ old('status', $room->status) == 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                </select>
            </div>

            <!-- Fecha -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Disponible desde
                </label>
                <input type="date" name="available_from" value="{{ old('available_from', $room->available_from ? \Carbon\Carbon::parse($room->available_from)->format('Y-m-d') : '') }}"
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
                        <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V4a1 1 0 10-2 0v7.586l-1.293-1.293z" />
                        <path d="M5 17a2 2 0 01-2-2V7a2 2 0 012-2 1 1 0 010 2v8a1 1 0 001 1h8a1 1 0 001-1V7a1 1 0 112 0v8a2 2 0 01-2 2H5z" />
                    </svg>
                    Actualizar Cambios
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
