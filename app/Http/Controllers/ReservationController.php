<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        try {
            return DB::transaction(function () use ($request) {
                // Bloquear la habitación para evitar cambios concurrentes
                $room = Room::where('id', $request->room_id)->lockForUpdate()->firstOrFail();

                // Nuevo algoritmo de solapamiento (Industria):
                // (Entrada < Nueva_Salida) AND (Salida > Nueva_Entrada)
                $overlap = Reservation::where('room_id', $request->room_id)
                    ->whereIn('status', ['confirmada', 'completada'])
                    ->where('check_in', '<', $request->check_out)
                    ->where('check_out', '>', $request->check_in)
                    ->exists();

                if ($overlap) {
                    return back()->withInput()->with('error', 'La habitación ya no está disponible para estas fechas (alguien más pudo haberla tomado).');
                }

                // Calcular precio total
                $totalPrice = Reservation::calculateTotal($request->room_id, $request->check_in, $request->check_out);

                $reservation = Reservation::create([
                    'cliente_id' => $request->cliente_id,
                    'room_id' => $request->room_id,
                    'check_in' => $request->check_in,
                    'check_out' => $request->check_out,
                    'total_price' => $totalPrice,
                    'status' => 'confirmada',
                    'notes' => $request->notes,
                ]);

                // Sincronizar estado de la habitación de inmediato
                $room->syncStatus();

                return redirect()->route('reservations.index')
                    ->with('success', 'Reserva #' . $reservation->id . ' confirmada. Total: $' . number_format($totalPrice, 2));
            });
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al procesar la reserva: ' . $e->getMessage());
        }
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
