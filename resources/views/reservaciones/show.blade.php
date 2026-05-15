@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Detalle de Reserva #{{ $reservation->id }}</h1>
        <div class="flex gap-2">
            <button onclick="window.print()" class="px-4 py-2 bg-gray-100 dark:bg-[#1C1C1B] dark:text-white rounded-lg hover:bg-gray-200 transition text-sm font-bold flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Imprimir
            </button>
            <a href="{{ route('reservations.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-bold text-sm">Volver</a>
        </div>
    </div>

    <div class="bg-white dark:bg-[#161615] rounded-3xl shadow-xl overflow-hidden border border-gray-100 dark:border-[#2a2a2a]">
        <!-- ENCABEZADO TICKET -->
        <div class="bg-indigo-600 p-8 text-white flex justify-between items-start">
            <div>
                <div class="text-3xl font-black uppercase tracking-tighter mb-1">COMPROBANTE</div>
                <div class="opacity-80 text-sm">Reserva Registrada: {{ $reservation->created_at->format('d/m/Y H:i') }}</div>
            </div>
            <div class="text-right">
                <div class="text-xl font-bold">HOTEL POS</div>
                <div class="text-xs opacity-75">San Salvador, El Salvador</div>
            </div>
        </div>

        <div class="p-8 space-y-8">
            <!-- DATOS CLIENTE Y HABITACION -->
            <div class="grid grid-cols-2 gap-8 border-b dark:border-[#2a2a2a] pb-8">
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Cliente</h3>
                    <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $reservation->cliente->nombre }} {{ $reservation->cliente->apellido }}</div>
                    <div class="text-sm text-gray-500">DUI: {{ $reservation->cliente->dui }}</div>
                    <div class="text-sm text-gray-500">{{ $reservation->cliente->correo_electronico }}</div>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Habitación</h3>
                    <div class="text-lg font-bold text-gray-900 dark:text-white">Número #{{ $reservation->room->room_number }}</div>
                    <div class="text-sm text-gray-500">Tipo: {{ ucfirst($reservation->room->type) }}</div>
                    <div class="text-sm text-gray-500">Estado Reserva: {{ ucfirst($reservation->status) }}</div>
                </div>
            </div>

            <!-- FECHAS -->
            <div class="grid grid-cols-3 gap-4 bg-gray-50 dark:bg-[#1C1C1B] p-6 rounded-2xl text-center">
                <div>
                    <div class="text-xs font-bold text-gray-400 uppercase mb-1">Llegada</div>
                    <div class="text-lg font-black dark:text-white">{{ $reservation->check_in->format('d M, Y') }}</div>
                </div>
                <div class="flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
                <div>
                    <div class="text-xs font-bold text-gray-400 uppercase mb-1">Salida</div>
                    <div class="text-lg font-black dark:text-white">{{ $reservation->check_out->format('d M, Y') }}</div>
                </div>
            </div>

            <!-- TOTAL -->
            <div class="flex justify-between items-center bg-indigo-50 dark:bg-indigo-900/20 p-6 rounded-2xl border border-indigo-100 dark:border-indigo-800">
                <div>
                    <div class="text-indigo-600 dark:text-indigo-400 font-bold uppercase text-xs">Total a Pagar</div>
                    <div class="text-sm text-gray-500">Incluye impuestos y precios por temporada</div>
                </div>
                <div class="text-4xl font-black text-indigo-600 dark:text-indigo-400">
                    ${{ number_format($reservation->total_price, 2) }}
                </div>
            </div>

            @if($reservation->notes)
            <div class="pt-4">
                <h3 class="text-xs font-bold text-gray-400 uppercase mb-2">Notas</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 italic">"{{ $reservation->notes }}"</p>
            </div>
            @endif
        </div>
        
        <!-- FOOTER TICKET -->
        <div class="bg-gray-50 dark:bg-[#1C1C1B] p-6 text-center text-[10px] text-gray-400 uppercase tracking-widest">
            Gracias por su preferencia • Este documento es un comprobante de reserva interna
        </div>
    </div>
</div>

<style>
@media print {
    body * { visibility: hidden; }
    .max-w-3xl, .max-w-3xl * { visibility: visible; }
    .max-w-3xl { position: absolute; left: 0; top: 0; width: 100%; }
    .px-4, .px-6, a, button { display: none !important; }
}
</style>
@endsection
