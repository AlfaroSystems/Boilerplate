@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Editar Precio por Temporada</h1>

    <div class="bg-white dark:bg-[#161615] rounded-xl shadow p-6 border dark:border-[#3E3E3A]">
        <form action="{{ route('seasonal-prices.update', $seasonalPrice) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">Habitación</label>
                <select name="room_id" required class="w-full p-2 border rounded dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ $seasonalPrice->room_id == $room->id ? 'selected' : '' }}>
                            Habitación #{{ $room->room_number }} ({{ $room->type }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">Descripción/Nombre Temporada</label>
                <input type="text" name="description" value="{{ old('description', $seasonalPrice->description) }}" required class="w-full p-2 border rounded dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-gray-700 dark:text-gray-300">Fecha Inicio</label>
                    <input type="date" name="start_date" value="{{ old('start_date', $seasonalPrice->start_date->format('Y-m-d')) }}" required class="w-full p-2 border rounded dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 dark:text-gray-300">Fecha Fin</label>
                    <input type="date" name="end_date" value="{{ old('end_date', $seasonalPrice->end_date->format('Y-m-d')) }}" required class="w-full p-2 border rounded dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
                </div>
            </div>

            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">Precio Especial (Noche)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $seasonalPrice->price) }}" required class="w-full p-2 border rounded dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
            </div>

            <div class="flex justify-between pt-4">
                <a href="{{ route('seasonal-prices.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-[#2a2a2a] dark:text-white rounded">Volver</a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded font-bold">Actualizar Precio</button>
            </div>
        </form>
    </div>
</div>
@endsection
