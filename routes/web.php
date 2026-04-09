<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

// Redirige a la raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'can:acceder-dashboard'])->name('dashboard');

/*
Rutas protegidas por autenticación
*/
Route::middleware(['auth', 'role:Admin'])->group(function () {
    // Gestión de usuarios
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('roles', RoleController::class);
    // Gestión de clientes
    Route::resource('clientes', \App\Http\Controllers\ClienteController::class);
});

require __DIR__ . '/auth.php';