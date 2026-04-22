<?php

namespace App\Observers;

use App\Models\Reservation;
use App\Models\Room;

class ReservationObserver
{
    /**
     * Handle the Reservation "created" event.
     */
    public function created(Reservation $reservation): void
    {
        $reservation->room->syncStatus();
    }

    public function updated(Reservation $reservation): void
    {
        // Si cambió de habitación, sincronizar ambas
        if ($reservation->wasChanged('room_id')) {
            Room::find($reservation->getOriginal('room_id'))?->syncStatus();
        }
        $reservation->room->syncStatus();
    }

    public function deleted(Reservation $reservation): void
    {
        $reservation->room->syncStatus();
    }

    /**
     * Handle the Reservation "restored" event.
     */
    public function restored(Reservation $reservation): void
    {
        //
    }

    /**
     * Handle the Reservation "force deleted" event.
     */
    public function forceDeleted(Reservation $reservation): void
    {
        //
    }
}
