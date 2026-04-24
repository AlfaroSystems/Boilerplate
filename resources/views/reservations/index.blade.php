@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Catálogo de Habitaciones</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Seleccione una habitación para iniciar una nueva reservación.</p>
        </div>
        <a href="{{ route('reservations.reservations') }}"
            class="px-5 py-2.5 bg-gray-100 dark:bg-[#1C1C1B] text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-200 transition text-sm font-bold shadow-sm border border-gray-200 dark:border-[#3E3E3A]">
            Ver Listado de Reservas
        </a>
    </div>

    <!-- LISTADO DE HABITACIONES (Airbnb Style) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($rooms as $room)
        <a href="{{ route('reservations.create', ['room_id' => $room->id]) }}" class="group cursor-pointer block">
            <!-- Imagen -->
            <div class="relative aspect-square overflow-hidden rounded-2xl mb-4 shadow-md transition-all duration-300 group-hover:shadow-xl">
                <img src="{{ $room->image_path ? asset('storage/' . $room->image_path) : asset('img/no-room.jpg') }}"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                <!-- Badge -->
                <div class="absolute top-4 left-4 bg-white/95 dark:bg-black/90 backdrop-blur-md px-3.5 py-1.5 rounded-full shadow-lg">
                    <span class="text-[11px] font-extrabold text-gray-900 dark:text-white uppercase tracking-widest">
                        {{ $room->status == 'disponible' ? 'Disponible' : 'Ocupado' }}
                    </span>
                </div>

                <!-- Heart Icon (Decoration) -->
                <div class="absolute top-4 right-4 text-white/90 hover:text-red-500 transition-colors drop-shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
            </div>

            <!-- Detalles -->
            <div class="space-y-1.5 px-1">
                <div class="flex justify-between items-center">
                    <h3 class="font-bold text-gray-900 dark:text-white text-lg tracking-tight">Habitación #{{ $room->room_number }}</h3>
                    <div class="flex items-center gap-1.5 text-sm">
                        <span class="text-yellow-400">★</span>
                        <span class="font-bold text-gray-900 dark:text-white">5.0</span>
                    </div>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-1 font-medium">{{ $room->type }} • {{ $room->description ?? 'Confort y elegancia asegurada' }}</p>
                <p class="text-sm text-gray-400 dark:text-gray-500 font-medium">Sistema de reserva inmediata</p>
                <div class="pt-1.5 flex items-baseline gap-1">
                    <span class="font-black text-gray-900 dark:text-white text-lg">${{ number_format($room->price, 2) }}</span>
                    <span class="text-gray-500 dark:text-gray-400 text-sm font-bold">noche</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection