<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            $table->string('nombre')->comment('Nombre o descripción del viaje');
            $table->enum('tipo', ['bus', 'avion', 'tren', 'crucero'])
                ->comment('Tipo de transporte utilizado');
            $table->bigInteger('origen')->comment('Ciudad o lugar de origen');
            $table->bigInteger('destino')->comment('Ciudad o lugar de destino');
            $table->foreignId('pais_id')->constrained('paises')->onDelete('cascade');
            $table->foreignId('provincia_id')->constrained('provincias')->onDelete('cascade');
            $table->foreignId('ciudad_id')->constrained('ciudades')->onDelete('cascade');
            $table->string('ubicacion')->comment('Ubicación actual del vehículo');
            $table->dateTime('fecha_salida')->comment('Fecha y hora de salida');
            $table->dateTime('fecha_llegada')->comment('Fecha y hora estimada de llegada');
            $table->string('numero_viaje')->comment('Número o código del viaje');
            $table->integer('capacidad_total')->comment('Capacidad total de pasajeros');
            $table->integer('asientos_disponibles')->comment('Número de asientos disponibles');
            $table->decimal('precio_base', 10, 2)->comment('Precio base del viaje');
            $table->text('descripcion')->nullable()->comment('Descripción detallada del viaje');
            $table->boolean('activo')->default(true)->comment('Indica si el viaje está disponible');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('viajes');
    }
};
