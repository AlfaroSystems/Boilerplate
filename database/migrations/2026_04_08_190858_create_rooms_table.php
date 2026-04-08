<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->string('room_number')->unique(); // número habitación

            $table->enum('type', ['individual', 'familiar', 'suite']); // tipo

            $table->decimal('price', 10, 2); // precio por noche

            $table->enum('status', ['disponible', 'ocupada', 'mantenimiento'])
                  ->default('disponible'); // estado

            $table->date('available_from')->nullable(); // disponible desde

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
