<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo - Componentes UI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @extends('layouts.app')

    @section('content')
        <div class="space-y-6">
            <h1 class="text-3xl font-bold dark:text-white">Bienvenido al Boilerplate</h1>

            <x-card>
                <x-slot name="header">
                    Ejemplo de Card
                </x-slot>

                <p>Este es un ejemplo de card con soporte para modo oscuro.</p>

                <div class="mt-4">
                    <x-input label="Nombre" placeholder="Ingresa tu nombre" />
                    <x-input label="Email" type="email" placeholder="tu@email.com" />

                    <x-primary-button>
                        Enviar
                    </x-primary-button>
                </div>
            </x-card>

            <x-card>
                <x-slot name="header">
                    Información del Sistema
                </x-slot>

                <ul class="space-y-2">
                    <li>✅ Laravel 11</li>
                    <li>✅ Tailwind CSS v4</li>
                    <li>✅ PostgreSQL</li>
                    <li>✅ Dark Mode</li>
                </ul>
            </x-card>
        </div>
    @endsection
</body>

</html>