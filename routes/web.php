<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

// Redirige a la raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {

    $user = auth()->user();

    // Admin → dashboard solo el admi accede 
    if ($user->hasRole('Admin')) {
        return view('dashboard');
    }

    //Usuario normal → Usuarios
    return redirect()->route('users.index');

})->middleware('auth')->name('dashboard');

/*
Rutas protegidas por autenticación
*/
Route::middleware('auth')->group(function () {
    // Gestión de usuarios
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
});

require __DIR__ . '/auth.php';