<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

    protected $fillable = [
        'room_number',
        'type',
        'price',
        'status',
        'available_from',
        'description',
        'image_path'
    ];

    // Opcional: casts para manejar tipos correctamente
    protected $casts = [
        'price' => 'decimal:2',
        'available_from' => 'date',
    ];

    /**
     * Sincroniza el estado de la habitación basado en las reservas actuales.
     */
    public function syncStatus()
    {
        // Si está en mantenimiento, no tocamos el estado automáticamente
        if ($this->status === 'mantenimiento') {
            return;
        }

        $newStatus = $this->is_occupied ? 'ocupada' : 'disponible';

        if ($this->status !== $newStatus) {
            $this->status = $newStatus;
            $this->save();
        }
    }

    public function seasonalPrices()
    {
        return $this->hasMany(SeasonalPrice::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Determina si la habitación está ocupada actualmente basado en reservas confirmadas.
     */
    public function getIsOccupiedAttribute()
    {
        return $this->reservations()
            ->where('status', 'confirmada')
            ->where('check_in', '<=', now()->format('Y-m-d'))
            ->where('check_out', '>', now()->format('Y-m-d'))
            ->exists();
    }
}