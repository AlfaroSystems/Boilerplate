<?php

namespace App\Observers;

use App\Models\Reservacion;
use App\Models\Habitacion;

class ReservacionObserver
{
    /**
     * Handle the Reservacion "created" event.
     */
    public function created(Reservacion $reservacion): void
    {
        $reservacion->habitacion->syncStatus();
    }

    public function updated(Reservacion $reservacion): void
    {
        // Si cambió de habitación, sincronizar ambas
        if ($reservacion->wasChanged('habitacion_id')) {
            Habitacion::find($reservacion->getOriginal('habitacion_id'))?->syncStatus();
        }
        $reservacion->habitacion->syncStatus();
    }

    public function deleted(Reservacion $reservacion): void
    {
        $reservacion->habitacion->syncStatus();
    }
}

