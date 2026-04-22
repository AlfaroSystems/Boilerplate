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
     * Sincronización masiva de estados de todas las habitaciones (Alto Rendimiento)
     */
    public static function syncAllStatuses()
    {
        // Ejecutar máximo una vez cada hora para ahorrar recursos
        $cacheKey = 'rooms_last_sync_hour';
        $currentHour = now()->format('Y-m-d-H');

        if (\Illuminate\Support\Facades\Cache::get($cacheKey) === $currentHour) {
            return;
        }

        $today = now()->format('Y-m-d');

        // 1. Resetear todas a disponible (excepto las que están en mantenimiento manual)
        self::where('status', '!=', 'mantenimiento')
            ->update(['status' => 'disponible']);

        // 2. Marcar como ocupadas aquellas con reservas confirmadas para hoy
        $occupiedRoomIds = Reservation::where('status', 'confirmada')
            ->where('check_in', '<=', $today)
            ->where('check_out', '>', $today)
            ->pluck('room_id');

        if ($occupiedRoomIds->isNotEmpty()) {
            self::whereIn('id', $occupiedRoomIds)
                ->where('status', '!=', 'mantenimiento')
                ->update(['status' => 'ocupada']);
        }

        \Illuminate\Support\Facades\Cache::put($cacheKey, $currentHour, 3600);
    }

    /**
     * Sincroniza el estado de una habitación individual.
     */
    public function syncStatus()
    {
        if ($this->status === 'mantenimiento') return;

        $newStatus = $this->is_occupied ? 'ocupada' : 'disponible';
        
        if ($this->status !== $newStatus) {
            $this->update(['status' => $newStatus]);
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