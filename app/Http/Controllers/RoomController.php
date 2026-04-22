<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;

class RoomController extends Controller
{
    // LISTAR
    public function index()
    {
        Gate::authorize('gestionar-rooms');

        $rooms = Room::all();

        return view('rooms.index', compact('rooms'));
    }

    // FORM CREAR
    public function create()
    {
        Gate::authorize('gestionar-rooms');

        return view('rooms.create');
    }

    // GUARDAR
    public function store(StoreRoomRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 'disponible'; // Forzado según requerimiento

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('rooms', 'public');
            $data['image_path'] = $path;
        }

        Room::create($data);

        return redirect()->route('rooms.index')
            ->with('success', 'Habitación registrada correctamente');
    }

    // FORM EDITAR
    public function edit(Room $room)
    {
        Gate::authorize('gestionar-rooms');

        return view('rooms.edit', compact('room'));
    }

    // ACTUALIZAR
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('rooms', 'public');
            $data['image_path'] = $path;
        }

        $room->update($data);

        return redirect()->route('rooms.index')
            ->with('success', 'Habitación actualizada correctamente');
    }

    // ELIMINAR
    public function destroy(Room $room)
    {
        Gate::authorize('gestionar-rooms');

        $room->delete();

        return redirect()->route('rooms.index')
            ->with('success', 'Habitación eliminada correctamente');
    }
}