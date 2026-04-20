<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['cliente', 'room'])->latest()->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $rooms = Room::all();
        $clientes = Cliente::all();
        return view('reservations.create', compact('rooms', 'clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'notes' => 'nullable|string',
        ]);

        // Verificar disponibilidad (evitar solapamiento)
        $overlap = Reservation::where('room_id', $request->room_id)
            ->where('status', 'confirmada')
            ->where(function($query) use ($request) {
                $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                      ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                      ->orWhere(function($q) use ($request) {
                          $q->where('check_in', '<=', $request->check_in)
                            ->where('check_out', '>=', $request->check_out);
                      });
            })->exists();

        if ($overlap) {
            return back()->withInput()->with('error', 'La habitación ya está reservada para esas fechas.');
        }

        // Calcular precio total
        $totalPrice = Reservation::calculateTotal($request->room_id, $request->check_in, $request->check_out);

        $data = $request->all();
        $data['total_price'] = $totalPrice;
        $data['status'] = 'confirmada'; // Por defecto para este flujo

        Reservation::create($data);

        return redirect()->route('reservations.index')
            ->with('success', 'Reserva creada correctamente. Total: $' . number_format($totalPrice, 2));
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $rooms = Room::all();
        $clientes = Cliente::all();
        return view('reservations.edit', compact('reservation', 'rooms', 'clientes'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pendiente,confirmada,cancelada,completada',
            'notes' => 'nullable|string',
        ]);

        $reservation->update($request->only(['status', 'notes']));

        return redirect()->route('reservations.index')
            ->with('success', 'Reserva actualizada correctamente');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')
            ->with('success', 'Reserva eliminada correctamente');
    }
}
