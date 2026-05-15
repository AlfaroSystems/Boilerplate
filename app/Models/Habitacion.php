<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    protected $table = 'habitaciones';

    protected $fillable = [
        'numero_habitacion',
        'tipo',
        'precio',
        'estado',
        'disponible_desde',
        'descripcion',
        'ruta_imagen'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'disponible_desde' => 'date',
    ];

    /**
     * Sincronización masiva de estados de todas las habitaciones (Alto Rendimiento)
     */
    public static function syncAllStatuses()
    {
        $cacheKey = 'habitaciones_last_sync_hour';
        $currentHour = now()->format('Y-m-d-H');

        if (\Illuminate\Support\Facades\Cache::get($cacheKey) === $currentHour) {
            return;
        }

        $today = now()->format('Y-m-d');

        // 1. Resetear todas a disponible (excepto las que están en mantenimiento manual)
        self::where('estado', '!=', 'mantenimiento')
            ->update(['estado' => 'disponible']);

        // 2. Marcar como ocupadas aquellas con reservas confirmadas para hoy
        $occupiedHabitacionIds = Reservacion::where('status', 'confirmada')
            ->where('fecha_entrada', '<=', $today)
            ->where('fecha_salida', '>', $today)
            ->pluck('habitacion_id');

        if ($occupiedHabitacionIds->isNotEmpty()) {
            self::whereIn('id', $occupiedHabitacionIds)
                ->where('estado', '!=', 'mantenimiento')
                ->update(['estado' => 'ocupada']);
        }

        \Illuminate\Support\Facades\Cache::put($cacheKey, $currentHour, 3600);
    }

    public function syncStatus()
    {
        if ($this->estado === 'mantenimiento') return;

        $newStatus = $this->es_ocupada ? 'ocupada' : 'disponible';
        
        if ($this->estado !== $newStatus) {
            $this->update(['estado' => $newStatus]);
        }
    }

    public function preciosTemporada()
    {
        return $this->hasMany(PrecioTemporada::class, 'habitacion_id');
    }

    public function reservaciones()
    {
        return $this->hasMany(Reservacion::class, 'habitacion_id');
    }

    public function imagenes()
    {
        return $this->hasMany(ImagenHabitacion::class, 'habitacion_id');
    }

    public function getEsOcupadaAttribute()
    {
        return $this->reservaciones()
            ->where('status', 'confirmada')
            ->where('fecha_entrada', '<=', now()->format('Y-m-d'))
            ->where('fecha_salida', '>', now()->format('Y-m-d'))
            ->exists();
    }
}