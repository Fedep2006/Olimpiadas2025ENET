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
        Schema::create('paquetes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->comment('Nombre comercial del paquete turístico');
            $table->text('descripcion')->nullable()->comment('Descripción detallada del paquete y sus servicios incluidos');
            $table->decimal('precio_total', 10, 2)->comment('Precio total del paquete en la moneda base del sistema');
            $table->string('duracion')->comment('Duración del paquete (ej: "3 días", "1 semana")');
            $table->string('ubicacion')->comment('Ubicación principal o destino del paquete');
            $table->integer('cupo_minimo')->default(1)->comment('Número mínimo de personas para realizar el paquete');
            $table->integer('cupo_maximo')->nullable()->comment('Número máximo de personas permitidas');
            $table->boolean('activo')->default(true)->comment('Indica si el paquete está disponible para reserva');
            $table->string('imagen')->nullable()->comment('URL de la imagen principal del paquete');
            $table->json('imagenes')->nullable()->comment('Array de URLs de imágenes adicionales del paquete');
            $table->text('condiciones')->nullable()->comment('Términos y condiciones específicos del paquete');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paquetes');
    }
};
