<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->comment('Nombre o descripción del viaje');
            $table->enum('tipo', ['bus', 'avion', 'tren', 'barco', 'transporte_privado'])
                ->comment('Tipo de transporte utilizado');
            $table->string('origen')->comment('Ciudad o lugar de origen');
            $table->string('destino')->comment('Ciudad o lugar de destino');
            $table->dateTime('fecha_salida')->comment('Fecha y hora de salida');
            $table->dateTime('fecha_llegada')->comment('Fecha y hora estimada de llegada');
            $table->string('empresa')->comment('Nombre de la compañía de transporte');
            $table->string('numero_viaje')->comment('Número o código del viaje');
            $table->integer('capacidad_total')->comment('Capacidad total de pasajeros');
            $table->integer('asientos_disponibles')->comment('Número de asientos disponibles');
            $table->decimal('precio_base', 10, 2)->comment('Precio base del viaje');
            $table->json('clases')->nullable()->comment('Array de clases disponibles (ej: ["económica", "business", "primera"])');
            $table->json('servicios')->nullable()->comment('Array de servicios incluidos (ej: ["wifi", "comida", "entretenimiento"])');
            $table->text('descripcion')->nullable()->comment('Descripción detallada del viaje');
            $table->text('observaciones')->nullable()->comment('Notas adicionales sobre el viaje');
            $table->boolean('activo')->default(true)->comment('Indica si el viaje está disponible');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viajes');
    }
};
