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
                
                <!-- Cliente (Buscador Dinámico) -->
                <div x-data="{
                    open: false,
                    search: '',
                    selectedId: '{{ old('cliente_id') }}',
                    selectedName: '{{ old('cliente_id') && $clientes->find(old('cliente_id')) ? $clientes->find(old('cliente_id'))->nombre . ' ' . $clientes->find(old('cliente_id'))->apellido . ' (' . $clientes->find(old('cliente_id'))->dui . ')' : '' }}',
                    clients: {{ $clientes->map(fn($c) => ['id' => $c->id, 'name' => $c->nombre . ' ' . $c->apellido, 'dui' => $c->dui])->toJson() }}
                }" class="relative">
                    <label class="block font-bold text-gray-700 dark:text-gray-300 mb-2 tracking-tight">Cliente</label>
                    
                    <div @click="open = !open" 
                        class="w-full p-2.5 border rounded-xl dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white cursor-pointer flex justify-between items-center transition hover:border-indigo-400 group"
                        :class="open ? 'ring-2 ring-indigo-500 border-transparent' : 'border-gray-200 dark:border-[#3E3E3A]'">
                        <span x-text="selectedName || 'Seleccione un cliente...'" :class="!selectedName && 'text-gray-400'"></span>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-500 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <input type="hidden" name="cliente_id" :value="selectedId" required>

                    <div x-show="open" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        @click.away="open = false" 
                        class="absolute z-50 w-full mt-2 bg-white dark:bg-[#1C1C1B] border dark:border-[#3E3E3A] rounded-2xl shadow-2xl overflow-hidden">
                        
                        <div class="p-3 border-b dark:border-[#3E3E3A] bg-gray-50/50 dark:bg-[#252524]/50">
                            <div class="relative">
                                <input type="text" x-model="search" placeholder="Buscar por nombre o DUI..." autofocus
                                    class="w-full pl-9 pr-4 py-2 bg-white dark:bg-[#1C1C1B] border border-gray-200 dark:border-[#3E3E3A] rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm dark:text-white outline-none transition">
                                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>

                        <div class="max-h-64 overflow-y-auto">
                            <template x-for="client in clients.filter(c => c.name.toLowerCase().includes(search.toLowerCase()) || c.dui.includes(search))" :key="client.id">
                                <div @click="selectedId = client.id; selectedName = client.name + ' (' + client.dui + ')'; open = false; search = ''"
                                    class="px-4 py-3 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 cursor-pointer transition flex flex-col border-b last:border-0 border-gray-50 dark:border-[#252524]">
                                    <span class="font-bold text-gray-900 dark:text-white text-sm" x-text="client.name"></span>
                                    <span class="text-[11px] text-gray-500 dark:text-gray-400 font-medium" x-text="'DUI: ' + client.dui"></span>
                                </div>
                            </template>
                            
                            <div x-show="clients.filter(c => c.name.toLowerCase().includes(search.toLowerCase()) || c.dui.includes(search)).length === 0"
                                class="px-4 py-10 text-center">
                                <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-gray-500 text-sm">No se encontraron clientes que coincidan.</p>
                            </div>
                        </div>
                    </div>
                    @error('cliente_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Habitación (Selección por Cards) -->
                <div x-data="{ selectedRoomId: '{{ request('room_id', old('room_id')) }}' }">
                    <label class="block font-bold text-gray-700 dark:text-gray-300 mb-4 text-lg">Seleccione una Habitación Disponible</label>
                    
                    <input type="hidden" name="room_id" :value="selectedRoomId" required>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @forelse($rooms as $room)
                            <div 
                                @click="selectedRoomId = '{{ $room->id }}'"
                                :class="selectedRoomId == '{{ $room->id }}' ? 'border-indigo-500 ring-2 ring-indigo-500/20' : 'border-gray-200 dark:border-[#2a2a2a] hover:border-indigo-300'"
                                class="cursor-pointer group bg-white dark:bg-[#1C1C1B] border rounded-2xl overflow-hidden transition-all duration-300 transform hover:-translate-y-1 shadow-sm"
                            >
                                <div class="relative h-32 overflow-hidden">
                                    <img src="{{ $room->image_path ? asset('storage/' . $room->image_path) : asset('img/no-room.jpg') }}" 
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute top-2 right-2 px-2 py-1 bg-white/90 dark:bg-black/80 rounded-lg text-xs font-bold text-indigo-600 dark:text-indigo-400">
                                        ${{ number_format($room->price, 2) }}
                                    </div>
                                    <div class="absolute bottom-2 left-2 px-2 py-1 bg-indigo-600 rounded-lg text-[10px] font-bold text-white uppercase">
                                        {{ $room->type }}
                                    </div>
                                </div>
                                <div class="p-3">
                                    <div class="flex items-center justify-between">
                                        <h4 class="font-bold text-gray-900 dark:text-white">Habitación #{{ $room->room_number }}</h4>
                                        <div x-show="selectedRoomId == '{{ $room->id }}'" class="text-indigo-500">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="text-[10px] text-gray-500 dark:text-gray-400 line-clamp-1 mt-1">
                                        {{ $room->description ?? 'Sin descripción disponible.' }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full p-8 text-center bg-gray-50 dark:bg-[#1C1C1B] rounded-2xl border-2 border-dashed border-gray-200 dark:border-[#2a2a2a]">
                                <p class="text-gray-500">No hay habitaciones disponibles en este momento.</p>
                            </div>
                        @endforelse
                    </div>
                    @error('room_id') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
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
