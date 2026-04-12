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
        'available_from'
    ];

    // Opcional: casts para manejar tipos correctamente
    protected $casts = [
        'price' => 'decimal:2',
        'available_from' => 'date',
    ];
}