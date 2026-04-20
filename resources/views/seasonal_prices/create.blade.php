@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Nueva Temporada y Precio</h1>

    <div class="bg-white dark:bg-[#161615] rounded-xl shadow p-6 border dark:border-[#3E3E3A]">
        <form action="{{ route('seasonal-prices.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">Seleccionar Habitación</label>
                <select name="room_id" required class="w-full p-2 border rounded dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
                    <option value="">Seleccione...</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">Habitación #{{ $room->room_number }} ({{ $room->type }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">Descripción/Nombre Temporada</label>
                <input type="text" name="description" placeholder="Ej: Navidad, Verano, Semana Santa" required class="w-full p-2 border rounded dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-gray-700 dark:text-gray-300">Fecha Inicio</label>
                    <input type="date" name="start_date" required class="w-full p-2 border rounded dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 dark:text-gray-300">Fecha Fin</label>
                    <input type="date" name="end_date" required class="w-full p-2 border rounded dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
                </div>
            </div>

            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">Precio Especial (Noche)</label>
                <input type="number" step="0.01" name="price" required class="w-full p-2 border rounded dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
            </div>

            <div class="flex justify-between pt-4">
                <a href="{{ route('seasonal-prices.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-[#2a2a2a] dark:text-white rounded">Volver</a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded font-bold">Guardar Precio</button>
            </div>
        </form>
    </div>
</div>
@endsection
