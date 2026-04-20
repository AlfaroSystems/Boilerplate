@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('reservations.index') }}" class="p-2 bg-gray-100 dark:bg-[#1C1C1B] rounded-lg hover:bg-gray-200 dark:hover:bg-[#2a2a2a] transition">
            <svg class="w-5 h-5 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Nueva Reservación</h1>
    </div>

    <form action="{{ route('reservations.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @csrf

        <!-- COLUMNA IZQUIERDA: DATOS -->
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white dark:bg-[#161615] rounded-2xl shadow-sm border border-gray-100 dark:border-[#2a2a2a] p-6 space-y-4">
                
                <!-- Cliente -->
                <div>
                    <label class="block font-bold text-gray-700 dark:text-gray-300 mb-2">Cliente</label>
                    <select name="cliente_id" required class="w-full p-2.5 border rounded-xl dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                        <option value="">Seleccione un cliente...</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nombre }} {{ $cliente->apellido }} ({{ $cliente->dui }})
                            </option>
                        @endforeach
                    </select>
                    @error('cliente_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Habitación -->
                <div x-data="{ selectedRoomImage: '' }">
                    <label class="block font-bold text-gray-700 dark:text-gray-300 mb-2">Habitación</label>
                    <select name="room_id" required 
                        x-on:change="selectedRoomImage = $event.target.selectedOptions[0].dataset.image"
                        class="w-full p-2.5 border rounded-xl dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                        <option value="" data-image="">Seleccione una habitación...</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" 
                                data-image="{{ $room->image_path }}"
                                {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                #{{ $room->room_number }} - {{ $room->type }} (${{ number_format($room->price, 2) }}/noche)
                            </option>
                        @endforeach
                    </select>
                    @error('room_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                    <!-- Preview -->
                    <template x-if="selectedRoomImage">
                        <div class="mt-4 animate-fade-in">
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Vista previa de la habitación:</label>
                            <img :src="'/storage/' + selectedRoomImage" class="w-full h-48 object-cover rounded-2xl border dark:border-[#3E3E3A] shadow-inner">
                        </div>
                    </template>
                </div>

                <!-- Fechas -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-gray-700 dark:text-gray-300 mb-2">Registro</label>
                        <input type="date" name="check_in" value="{{ old('check_in', date('Y-m-d')) }}" required
                            class="w-full p-2.5 border rounded-xl dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700 dark:text-gray-300 mb-2">Salida</label>
                        <input type="date" name="check_out" value="{{ old('check_out', date('Y-m-d', strtotime('+1 day'))) }}" required
                            class="w-full p-2.5 border rounded-xl dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                    </div>
                </div>

                <!-- Notas -->
                <div>
                    <label class="block font-bold text-gray-700 dark:text-gray-300 mb-2">Notas Especiales</label>
                    <textarea name="notes" rows="3" class="w-full p-2.5 border rounded-xl dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">{{ old('notes') }}</textarea>
                </div>
            </div>
        </div>

        <!-- COLUMNA DERECHA: RESUMEN Y BOTÓN -->
        <div class="space-y-6">
            <div class="bg-indigo-600 rounded-2xl shadow-lg p-6 text-white space-y-4">
                <h3 class="font-bold text-lg border-b border-indigo-400 pb-2">Resumen de Reserva</h3>
                <div class="space-y-2 text-sm opacity-90">
                    <p>• Los precios se calculan automáticamente incluyendo temporadas.</p>
                    <p>• El total se verá en la confirmación final.</p>
                </div>
                <button type="submit" class="w-full py-3 bg-white text-indigo-600 rounded-xl font-bold uppercase tracking-wider hover:bg-gray-100 transition shadow-md">
                    Confirmar Reserva
                </button>
            </div>

            <div class="bg-white dark:bg-[#161615] rounded-2xl p-6 border border-gray-100 dark:border-[#2a2a2a] text-sm text-gray-500">
                <p>⚠️ Asegúrese de que las fechas sean correctas. El sistema validará si la habitación ya está ocupada.</p>
            </div>
        </div>

    </form>
</div>
@endsection
