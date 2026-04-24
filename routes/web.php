<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Models\Room;
use App\Models\Cliente;
use Illuminate\Support\Facades\Route;

// Redirige a la raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard
Route::get('/dashboard', function () {
    // Sincronización masiva de estados (Alta Eficiencia)
    Room::syncAllStatuses();

    $totalRooms = Room::count();
    $availableRooms = Room::where('status', 'disponible')->count();
    $occupiedRooms = Room::where('status', 'ocupada')->count();
    $totalClients = Cliente::count();
    
    $occupancyRate = $totalRooms > 0 ? ($occupiedRooms / $totalRooms) * 100 : 0;
    $rooms = Room::with('images')->get();

    return view('dashboard', compact('totalRooms', 'availableRooms', 'occupiedRooms', 'totalClients', 'occupancyRate', 'rooms'));
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

    // Gestión de habitaciones
    Route::resource('rooms', RoomController::class);
    Route::resource('seasonal-prices', \App\Http\Controllers\SeasonalPriceController::class);
    
    Route::get('reservations/list', [\App\Http\Controllers\ReservationController::class, 'reservations'])->name('reservations.reservations');
    Route::resource('reservations', \App\Http\Controllers\ReservationController::class);
});

require __DIR__ . '/auth.php';