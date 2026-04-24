<?php

namespace App\Http\Controllers;

use App\Models\SeasonalPrice;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreSeasonalPriceRequest;
use App\Http\Requests\UpdateSeasonalPriceRequest;

class SeasonalPriceController extends Controller
{
    public function index()
    {
        Gate::authorize('gestionar-seasonal_prices');
        $prices = SeasonalPrice::with('room')->get();
        return view('seasonal_prices.index', compact('prices'));
    }

    public function create()
    {
        Gate::authorize('gestionar-seasonal_prices');
        $rooms = Room::all();
        return view('seasonal_prices.create', compact('rooms'));
    }

    public function store(StoreSeasonalPriceRequest $request)
    {
        // Validación de solapamiento
        $overlap = SeasonalPrice::where('room_id', $request->room_id)
            ->where('start_date', '<', $request->end_date)
            ->where('end_date', '>', $request->start_date)
            ->exists();

        if ($overlap) {
            return back()->withInput()->with('error', 'Ya existe un precio configurado que se solapa con estas fechas para esta habitación.');
        }

        SeasonalPrice::create($request->validated());

        return redirect()->route('seasonal-prices.index')
            ->with('success', 'Precio por temporada registrado correctamente');
    }

    public function edit(SeasonalPrice $seasonalPrice)
    {
        Gate::authorize('gestionar-seasonal_prices');
        $rooms = Room::all();
        return view('seasonal_prices.edit', compact('seasonalPrice', 'rooms'));
    }

    public function update(UpdateSeasonalPriceRequest $request, SeasonalPrice $seasonalPrice)
    {
        // Validación de solapamiento (excluyendo el actual)
        $overlap = SeasonalPrice::where('room_id', $request->room_id)
            ->where('id', '!=', $seasonalPrice->id)
            ->where('start_date', '<', $request->end_date)
            ->where('end_date', '>', $request->start_date)
            ->exists();

        if ($overlap) {
            return back()->withInput()->with('error', 'Ya existe otro precio configurado que se solapa con estas fechas.');
        }

        $seasonalPrice->update($request->validated());

        return redirect()->route('seasonal-prices.index')
            ->with('success', 'Precio por temporada actualizado correctamente');
    }

    public function destroy(SeasonalPrice $seasonalPrice)
    {
        Gate::authorize('gestionar-seasonal_prices');
        $seasonalPrice->delete();
        return redirect()->route('seasonal-prices.index')
            ->with('success', 'Precio por temporada eliminado correctamente');
    }
}
