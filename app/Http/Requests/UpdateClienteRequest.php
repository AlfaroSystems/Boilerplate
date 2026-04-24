<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('gestionar-clientes');
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'distrito' => 'required|string|max:255',
            'direccion_completa' => 'required|string',
            'telefono' => 'required|string|max:20',
            'correo_electronico' => 'nullable|email|max:255',
            'dui' => 'required|string|max:10',
            'nrc' => 'nullable|string|max:20',
        ];
    }
}
