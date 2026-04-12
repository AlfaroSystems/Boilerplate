<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Gate;

class RoomController extends Controller
{
    // LISTAR
    public function index()
    {
        Gate::authorize('gestionar-habitaciones');

        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    // FORM CREAR
    public function create()
    {
        Gate::authorize('gestionar-habitaciones');

        return view('rooms.create');
    }

    // GUARDAR
    public function store(Request $request)
    {
        Gate::authorize('gestionar-habitaciones');

        $request->validate([
            'room_number' => 'required|string|max:50|unique:rooms,room_number',
            'type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string',
            'available_from' => 'nullable|date',
        ], [
            'room_number.unique' => 'Este número de habitación ya está registrado',
            'room_number.required' => 'El número de habitación es obligatorio',
            'price.required' => 'El precio es obligatorio',
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index')
            ->with('success', 'Habitación registrada correctamente');
    }

    // FORM EDITAR
    public function edit(Room $room)
    {
        Gate::authorize('gestionar-habitaciones');

        return view('rooms.edit', compact('room'));
    }

    // ACTUALIZAR
    public function update(Request $request, Room $room)
    {
        Gate::authorize('gestionar-habitaciones');

        $request->validate([
            'room_number' => 'required|string|max:50|unique:rooms,room_number,' . $room->id,
            'type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string',
            'available_from' => 'nullable|date',
        ], [
            'room_number.unique' => 'Este número de habitación ya está en uso',
        ]);

        $room->update($request->all());

        return redirect()->route('rooms.index')
            ->with('success', 'Habitación actualizada correctamente');
    }

    // ELIMINAR
    public function destroy(Room $room)
    {
        Gate::authorize('gestionar-habitaciones');

        $room->delete();

        return redirect()->route('rooms.index')
            ->with('success', 'Habitación eliminada correctamente');
    }
}