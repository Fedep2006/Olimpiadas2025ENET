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
        Schema::create('hospedajes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->comment('Nombre comercial del establecimiento');
            $table->enum('tipo', ['hotel', 'hostal', 'apartamento', 'casa', 'cabaña', 'resort'])
                ->comment('Tipo de establecimiento de hospedaje');
            $table->string('ubicacion')->comment('Dirección física del establecimiento');
            $table->string('pais')->comment('País donde se encuentra el establecimiento');
            $table->string('ciudad')->comment('Ciudad donde se encuentra el establecimiento');
            $table->string('codigo_postal')->nullable()->comment('Código postal de la ubicación');
            $table->integer('estrellas')->nullable()->comment('Clasificación del establecimiento (1 a 5 estrellas)');
            $table->boolean('disponibilidad')->default(true)->comment('Indica si el establecimiento está disponible para reservas');
            $table->text('descripcion')->nullable()->comment('Descripción detallada del establecimiento y sus instalaciones');
            $table->json('servicios')->nullable()->comment('Array de servicios ofrecidos (wifi, piscina, restaurante, etc.)');
            $table->json('imagenes')->nullable()->comment('Array de URLs de imágenes adicionales del establecimiento');
            $table->string('telefono')->nullable()->comment('Número de teléfono de contacto');
            $table->string('email')->nullable()->comment('Correo electrónico de contacto');
            $table->string('sitio_web')->nullable()->comment('URL del sitio web oficial');
            $table->time('check_in')->default('14:00:00')->comment('Hora estándar de check-in');
            $table->time('check_out')->default('12:00:00')->comment('Hora estándar de check-out');
            $table->boolean('check_in_24h')->default(false)->comment('Indica si el establecimiento permite check-in las 24 horas');
            $table->decimal('calificacion', 3, 2)->nullable()->comment('Calificación promedio del establecimiento (0.00 a 5.00)');
            $table->json('politicas')->nullable()->comment('Array de políticas del establecimiento (mascotas, niños, etc.)');
            $table->text('observaciones')->nullable()->comment('Notas adicionales sobre el establecimiento');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospedajes');
    }
};
