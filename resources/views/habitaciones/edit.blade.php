@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">

    <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">
        Editar Habitación: {{ $habitacion->numero_habitacion }}
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

        <form action="{{ route('habitaciones.update', $habitacion) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Número de habitación
                </label>
                <input type="text" name="numero_habitacion" value="{{ old('numero_habitacion', $habitacion->numero_habitacion) }}"
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
            </div>

            <!-- Tipo -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Tipo
                </label>
                <select name="tipo"
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                    <option value="individual" {{ old('tipo', $habitacion->tipo) == 'individual' ? 'selected' : '' }}>Individual</option>
                    <option value="familiar" {{ old('tipo', $habitacion->tipo) == 'familiar' ? 'selected' : '' }}>Familiar</option>
                    <option value="suite" {{ old('tipo', $habitacion->tipo) == 'suite' ? 'selected' : '' }}>Suite</option>
                </select>
            </div>

            <!-- Precio -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Precio por noche
                </label>
                <input type="number" step="0.01" name="precio" value="{{ old('precio', $habitacion->precio) }}"
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
            </div>

            <!-- Descripción -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    ¿Qué contiene la habitación? (Camas, baño, etc.)
                </label>
                <textarea name="descripcion" rows="3"
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">{{ old('descripcion', $habitacion->descripcion) }}</textarea>
            </div>

            <!-- Fotografías -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Fotografías de la habitación
                </label>
                
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                    <!-- Imagen Principal -->
                    @if($habitacion->ruta_imagen)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $habitacion->ruta_imagen) }}" alt="Principal" class="w-full h-24 object-cover rounded-lg shadow-sm border-2 border-indigo-500">
                            <span class="absolute top-1 left-1 bg-indigo-500 text-white text-[10px] px-1.5 py-0.5 rounded uppercase font-bold">Principal</span>
                        </div>
                    @endif

                    <!-- Imágenes Adicionales -->
                    @foreach($habitacion->imagenes as $img)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $img->ruta_imagen) }}" alt="Adicional" class="w-full h-24 object-cover rounded-lg shadow-sm">
                        </div>
                    @endforeach
                </div>

                <p class="text-xs text-gray-500 mb-2 italic">Subir más fotografías (se añadirán a la galería):</p>
                <input type="file" name="imagenes[]" accept="image/*" multiple
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
            </div>

            <!-- Estado -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Estado
                </label>
                <select name="estado"
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                    <option value="disponible" {{ old('estado', $habitacion->estado) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="ocupada" {{ old('estado', $habitacion->estado) == 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                    <option value="mantenimiento" {{ old('estado', $habitacion->estado) == 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                </select>
            </div>

            <!-- Fecha -->
            <div>
                <label class="block font-semibold text-gray-700 dark:text-gray-300">
                    Disponible desde
                </label>
                <input type="date" name="disponible_desde" value="{{ old('disponible_desde', $habitacion->disponible_desde ? \Carbon\Carbon::parse($habitacion->disponible_desde)->format('Y-m-d') : '') }}"
                    class="w-full p-2 border rounded bg-white dark:bg-[#1C1C1B] dark:border-[#3E3E3A] dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
            </div>

            <!-- BOTONES -->
            <div class="flex justify-between mt-6">
                <a href="{{ route('habitaciones.index') }}"
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
