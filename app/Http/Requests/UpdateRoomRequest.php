<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
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
        $room = $this->route('room');
        return [
            'room_number' => 'required|string|max:50|unique:rooms,room_number,' . $room->id,
            'type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string|in:disponible,ocupada,mantenimiento',
            'available_from' => 'nullable|date',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'room_number.unique' => 'Este número de habitación ya está en uso',
        ];
    }
}
