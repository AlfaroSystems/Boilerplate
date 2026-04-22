<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'room_id',
        'check_in',
        'check_out',
        'total_price',
        'status',
        'notes'
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'total_price' => 'decimal:2',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Calcula el precio total basado en el precio base y temporadas.
     */
    public static function calculateTotal($roomId, $startDate, $endDate)
    {
        $room = Room::findOrFail($roomId);
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        $total = 0;

        // Obtener todos los precios estacionales relevantes en una sola consulta
        $seasonalPrices = $room->seasonalPrices()
            ->where('start_date', '<=', $end->format('Y-m-d'))
            ->where('end_date', '>=', $start->format('Y-m-d'))
            ->get();

        // Iterar por cada noche (desde start hasta antes de end)
        for ($date = $start->copy(); $date->lt($end); $date->addDay()) {
            $currentDateStr = $date->format('Y-m-d');
            
            // Buscar en la colección cargada si hay un precio de temporada para esta fecha
            $seasonal = $seasonalPrices->first(function ($price) use ($currentDateStr) {
                return $price->start_date <= $currentDateStr && $price->end_date >= $currentDateStr;
            });

            if ($seasonal) {
                $total += $seasonal->price;
            } else {
                $total += $room->price;
            }
        }

        return $total;
    }
}
