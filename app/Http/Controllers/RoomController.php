<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomImage;
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

        $room = Room::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('rooms', 'public');
                
                // La primera imagen será la principal
                if ($index === 0) {
                    $room->update(['image_path' => $path]);
                } else {
                    $room->images()->create(['image_path' => $path]);
                }
            }
        }

        return redirect()->route('rooms.index')
            ->with('success', 'Habitación registrada correctamente');
    }

    // FORM EDITAR
    public function edit(Room $room)
    {
        Gate::authorize('gestionar-rooms');
        $room->load('images');

        return view('rooms.edit', compact('room'));
    }

    // ACTUALIZAR
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $data = $request->validated();
        
        $room->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('rooms', 'public');
                $room->images()->create(['image_path' => $path]);
            }
        }

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