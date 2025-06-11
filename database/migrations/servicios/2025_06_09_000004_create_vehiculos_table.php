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
            $table->string('ubicacion')->comment('Ubicación actual del vehículo');
            $table->decimal('precio_por_dia', 10, 2)->comment('Precio de alquiler por día en la moneda base');
            $table->boolean('disponible')->default(true)->comment('Indica si el vehículo está disponible para alquiler');
            $table->string('imagen')->nullable()->comment('URL de la imagen principal del vehículo');
            $table->json('imagenes')->nullable()->comment('Array de URLs de imágenes adicionales del vehículo');
            $table->json('caracteristicas')->nullable()->comment('Array de características del vehículo (ej: ["aire acondicionado", "GPS", "bluetooth", "cámara de reversa"])');
            $table->text('observaciones')->nullable()->comment('Notas adicionales sobre el vehículo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
