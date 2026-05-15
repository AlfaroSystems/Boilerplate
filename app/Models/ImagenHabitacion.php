<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenHabitacion extends Model
{
    protected $table = 'imagenes_habitacion';

    protected $fillable = ['habitacion_id', 'ruta_imagen'];

    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class, 'habitacion_id');
    }
}

