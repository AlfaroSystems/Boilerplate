<?php

namespace App\Http\Controllers;

use App\Models\PrecioTemporada;
use App\Models\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePrecioTemporadaRequest;
use App\Http\Requests\UpdatePrecioTemporadaRequest;

class PrecioTemporadaController extends Controller
{
    public function index()
    {
        Gate::authorize('gestionar-precios_temporada');
        $precios = PrecioTemporada::with('habitacion')->get();
        return view('precios_temporada.index', compact('precios'));
    }

    public function create()
    {
        Gate::authorize('gestionar-precios_temporada');
        $habitaciones = Habitacion::all();
        return view('precios_temporada.create', compact('habitaciones'));
    }

    public function store(StorePrecioTemporadaRequest $request)
    {
        // Validación de solapamiento
        $overlap = PrecioTemporada::where('habitacion_id', $request->habitacion_id)
            ->where('fecha_inicio', '<', $request->fecha_fin)
            ->where('fecha_fin', '>', $request->fecha_inicio)
            ->exists();

        if ($overlap) {
            return back()->withInput()->with('error', 'Ya existe un precio configurado que se solapa con estas fechas para esta habitación.');
        }

        PrecioTemporada::create($request->validated());

        return redirect()->route('precios-temporada.index')
            ->with('success', 'Precio por temporada registrado correctamente');
    }

    public function edit(PrecioTemporada $precioTemporada)
    {
        Gate::authorize('gestionar-precios_temporada');
        $habitaciones = Habitacion::all();
        return view('precios_temporada.edit', compact('precioTemporada', 'habitaciones'));
    }

    public function update(UpdatePrecioTemporadaRequest $request, PrecioTemporada $precioTemporada)
    {
        // Validación de solapamiento (excluyendo el actual)
        $overlap = PrecioTemporada::where('habitacion_id', $request->habitacion_id)
            ->where('id', '!=', $precioTemporada->id)
            ->where('fecha_inicio', '<', $request->fecha_fin)
            ->where('fecha_fin', '>', $request->fecha_inicio)
            ->exists();

        if ($overlap) {
            return back()->withInput()->with('error', 'Ya existe otro precio configurado que se solapa con estas fechas.');
        }

        $precioTemporada->update($request->validated());

        return redirect()->route('precios-temporada.index')
            ->with('success', 'Precio por temporada actualizado correctamente');
    }

    public function destroy(PrecioTemporada $precioTemporada)
    {
        Gate::authorize('gestionar-precios_temporada');
        $precioTemporada->delete();
        return redirect()->route('precios-temporada.index')
            ->with('success', 'Precio por temporada eliminado correctamente');
    }
}

