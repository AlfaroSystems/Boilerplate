<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] antialiased transition-colors duration-300">
    @extends('layouts.app')

    @section('content')
        <div class="max-w-4xl mx-auto space-y-12 py-10">
            <div class="text-center space-y-4">
                <h1 class="text-5xl font-extrabold text-indigo-600 dark:text-indigo-400 tracking-tight">
                    Dev 2: UI & Frontend
                </h1>
                <p class="text-xl text-gray-600 dark:text-[#A1A09A]">
                    Componentes base y sistema de diseño listos para el siguiente paso.
                </p>
            </div>

            <!-- Demostración de Componentes -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <x-card>
                    <x-slot name="header">Componente: x-card</x-slot>
                    <p>Las cards soportan headers, slots de contenido y modo oscuro automático.</p>
                    <div class="mt-4">
                        <x-primary-button>Botón Demo</x-primary-button>
                    </div>
                </x-card>

                <x-card>
                    <x-slot name="header">Componente: x-input</x-slot>
                    <div class="space-y-4">
                        <x-input label="Nombre de Usuario" placeholder="Ej: erika_dev" />
                        <x-input label="Correo Electrónico" type="email" placeholder="ejemplo@correo.com" />
                    </div>
                </x-card>
            </div>

            <x-card>
                <x-slot name="header">Paleta de Colores (Modo Oscuro)</x-slot>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="p-4 rounded-lg bg-[#0a0a0a] border border-[#3E3E3A] text-white text-center text-xs">Bg
                        #0a0a0a</div>
                    <div class="p-4 rounded-lg bg-[#161615] border border-[#3E3E3A] text-white text-center text-xs">Card
                        #161615</div>
                    <div class="p-4 rounded-lg bg-[#3E3E3A] text-white text-center text-xs">Border #3E3E3A</div>
                    <div class="p-4 rounded-lg bg-indigo-600 text-white text-center text-xs">Primary Indigo</div>
                </div>
            </x-card>

            <div class="text-center pt-10">
                <p class="text-sm text-gray-500">Listo para que el compañero de **Dev 3 (Auth)** tome el relevo.</p>
            </div>
        </div>

        <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
            class="fixed bottom-8 right-8 p-3 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-full shadow-lg transition-transform hover:scale-110 dark:text-white">
            <span x-text="darkMode ? '☀️' : '🌙'"></span>
        </button>
    @endsection
</body>

</html>