<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;
use App\Models\ImagenHabitacion;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreHabitacionRequest;
use App\Http\Requests\UpdateHabitacionRequest;

class HabitacionController extends Controller
{
    // LISTAR
    public function index()
    {
        Gate::authorize('gestionar-habitaciones');

        $habitaciones = Habitacion::all();

        return view('habitaciones.index', compact('habitaciones'));
    }

    // FORM CREAR
    public function create()
    {
        Gate::authorize('gestionar-habitaciones');

        return view('habitaciones.create');
    }

    // GUARDAR
    public function store(StoreHabitacionRequest $request)
    {
        $data = $request->validated();
        $data['estado'] = 'disponible';

        $habitacion = Habitacion::create($data);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $index => $imagen) {
                $ruta = $imagen->store('habitaciones', 'public');
                
                // La primera imagen será la principal
                if ($index === 0) {
                    $habitacion->update(['ruta_imagen' => $ruta]);
                } else {
                    $habitacion->imagenes()->create(['ruta_imagen' => $ruta]);
                }
            }
        }

        return redirect()->route('habitaciones.index')
            ->with('success', 'Habitación registrada correctamente');
    }

    // FORM EDITAR
    public function edit(Habitacion $habitacion)
    {
        Gate::authorize('gestionar-habitaciones');
        $habitacion->load('imagenes');

        return view('habitaciones.edit', compact('habitacion'));
    }

    // ACTUALIZAR
    public function update(UpdateHabitacionRequest $request, Habitacion $habitacion)
    {
        $data = $request->validated();
        
        $habitacion->update($data);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $ruta = $imagen->store('habitaciones', 'public');
                $habitacion->imagenes()->create(['ruta_imagen' => $ruta]);
            }
        }

        return redirect()->route('habitaciones.index')
            ->with('success', 'Habitación actualizada correctamente');
    }

    // ELIMINAR
    public function destroy(Habitacion $habitacion)
    {
        Gate::authorize('gestionar-habitaciones');

        $habitacion->delete();

        return redirect()->route('habitaciones.index')
            ->with('success', 'Habitación eliminada correctamente');
    }
}