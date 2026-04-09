<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

// Redirige a la raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'can:acceder-dashboard'])->name('dashboard');

// Perfil
Route::middleware(['auth', 'can:editar-perfil'])->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

/*
Rutas protegidas por autenticación
*/
Route::middleware(['auth'])->group(function () {

    // Gestión de usuarios
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('roles', RoleController::class);
    // Gestión de clientes
    Route::resource('clientes', \App\Http\Controllers\ClienteController::class);
});

require __DIR__ . '/auth.php';