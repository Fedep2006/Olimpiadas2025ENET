<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['auto', 'camioneta', 'moto', 'bicicleta'])
                ->comment('Tipo de vehículo disponible para alquiler');
            $table->string('marca')->comment('Marca del vehículo');
            $table->string('modelo')->comment('Modelo del vehículo');
            $table->string('antiguedad')->comment('Año de fabricación del vehículo');
            $table->string('patente', 10)->unique()->comment('Número de patente o matrícula del vehículo');
            $table->string('color')->comment('Color del vehículo');
            $table->integer('capacidad_pasajeros')->comment('Número máximo de pasajeros permitidos');
            $table->integer('vehiculos_disponibles')->comment('Numero restante de vehiculos');
            $table->foreignId('pais_id')->constrained('paises')->onDelete('cascade');
            $table->foreignId('provincia_id')->constrained('provincias')->onDelete('cascade');
            $table->foreignId('ciudad_id')->constrained('ciudades')->onDelete('cascade');
            $table->string('ubicacion')->comment('Ubicación actual del vehículo');
            $table->decimal('precio_por_dia', 10, 2)->comment('Precio de alquiler por día en la moneda base');
            $table->text('descripcion')->nullable()->comment('Descripción detallada del vehiculo');
            $table->boolean('disponible')->default(true)->comment('Indica si el vehículo está disponible para alquiler');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
