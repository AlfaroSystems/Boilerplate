<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('gestionar-rooms');
    }

    public function rules(): array
    {
        return [
            'room_number' => 'required|string|max:50|unique:rooms,room_number',
            'type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'room_number.unique' => 'Este número de habitación ya está registrado',
            'room_number.required' => 'El número de habitación es obligatorio',
            'price.required' => 'El precio es obligatorio',
        ];
    }
}
