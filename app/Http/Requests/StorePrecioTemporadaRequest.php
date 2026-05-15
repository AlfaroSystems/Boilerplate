<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrecioTemporadaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('gestionar-precios_temporada');
    }

    public function rules(): array
    {
        return [
            'habitacion_id' => 'required|exists:habitaciones,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string|max:255',
        ];
    }
}

