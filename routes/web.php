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

Route::middleware(['auth', 'can:editar-perfil'])->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

/*
Rutas protegidas por autenticación
*/
Route::middleware(['auth'])->group(function () {
    // Gestión de usuarios
    Route::resource('users', \App\Http\Controllers\UserController::class)->middleware('can:gestionar-usuarios');
    // Gestión de roles
    Route::resource('roles', RoleController::class)->middleware('can:gestionar-roles');
});

require __DIR__ . '/auth.php';