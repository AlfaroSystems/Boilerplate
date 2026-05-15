<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id();
            $table->string('numero_habitacion')->unique();
            $table->enum('tipo', ['individual', 'familiar', 'suite']);
            $table->decimal('precio', 10, 2);
            $table->enum('estado', ['disponible', 'ocupada', 'mantenimiento'])
                  ->default('disponible');
            $table->date('disponible_desde')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('habitaciones');
    }

};
