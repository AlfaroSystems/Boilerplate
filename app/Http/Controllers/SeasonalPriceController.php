<?php

namespace App\Http\Controllers;

use App\Models\SeasonalPrice;
use App\Models\Room;
use Illuminate\Http\Request;

class SeasonalPriceController extends Controller
{
    public function index()
    {
        $prices = SeasonalPrice::with('room')->get();
        return view('seasonal_prices.index', compact('prices'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('seasonal_prices.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        SeasonalPrice::create($request->all());

        return redirect()->route('seasonal-prices.index')
            ->with('success', 'Precio por temporada registrado correctamente');
    }

    public function edit(SeasonalPrice $seasonalPrice)
    {
        $rooms = Room::all();
        return view('seasonal_prices.edit', compact('seasonalPrice', 'rooms'));
    }

    public function update(Request $request, SeasonalPrice $seasonalPrice)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        $seasonalPrice->update($request->all());

        return redirect()->route('seasonal-prices.index')
            ->with('success', 'Precio por temporada actualizado correctamente');
    }

    public function destroy(SeasonalPrice $seasonalPrice)
    {
        $seasonalPrice->delete();
        return redirect()->route('seasonal-prices.index')
            ->with('success', 'Precio por temporada eliminado correctamente');
    }
}
