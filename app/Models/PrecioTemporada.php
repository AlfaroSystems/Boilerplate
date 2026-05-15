<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecioTemporada extends Model
{
    use HasFactory;

    protected $table = 'precios_temporada';

    protected $fillable = [
        'habitacion_id',
        'fecha_inicio',
        'fecha_fin',
        'precio',
        'descripcion'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'precio' => 'decimal:2'
    ];

    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class, 'habitacion_id');
    }
}

