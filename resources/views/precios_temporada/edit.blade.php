@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Editar Precio por Temporada</h1>

    <div class="bg-white dark:bg-[#161615] rounded-xl shadow p-6 border dark:border-[#3E3E3A]">
        <form action="{{ route('precios-temporada.update', $precioTemporada) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">Habitación</label>
                <select name="habitacion_id" required class="w-full p-2 border rounded dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
                    @foreach($habitaciones as $habitacion)
                        <option value="{{ $habitacion->id }}" {{ $precioTemporada->habitacion_id == $habitacion->id ? 'selected' : '' }}>
                            Habitación #{{ $habitacion->numero_habitacion }} ({{ $habitacion->tipo }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">Descripción/Nombre Temporada</label>
                <input type="text" name="descripcion" value="{{ old('descripcion', $precioTemporada->descripcion) }}" required class="w-full p-2 border rounded dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-gray-700 dark:text-gray-300">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', $precioTemporada->fecha_inicio->format('Y-m-d')) }}" required class="w-full p-2 border rounded dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 dark:text-gray-300">Fecha Fin</label>
                    <input type="date" name="fecha_fin" value="{{ old('fecha_fin', $precioTemporada->fecha_fin->format('Y-m-d')) }}" required class="w-full p-2 border rounded dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
                </div>
            </div>

            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">Precio Especial (Noche)</label>
                <input type="number" step="0.01" name="precio" value="{{ old('precio', $precioTemporada->precio) }}" required class="w-full p-2 border rounded dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white">
            </div>

            <div class="flex justify-between pt-4">
                <a href="{{ route('precios-temporada.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-[#2a2a2a] dark:text-white rounded">Volver</a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded font-bold">Actualizar Precio</button>
            </div>
        </form>
    </div>
</div>
@endsection

