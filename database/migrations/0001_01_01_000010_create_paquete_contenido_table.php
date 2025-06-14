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
        Schema::create('paquete_contenido', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paquete_id')->constrained('paquetes')->onDelete('cascade')
                ->comment('ID del paquete turístico al que pertenece este contenido');
            $table->enum('tipo_contenido', ['viaje', 'hospedaje', 'vehiculo'])
                ->comment('Tipo de contenido: viaje (transporte), hospedaje (alojamiento), vehiculo (alquiler)');
            $table->unsignedBigInteger('contenido_id')
                ->comment('ID del elemento específico según el tipo_contenido (viaje_id, hospedaje_id o vehiculo_id)');
            $table->text('observaciones')->nullable()
                ->comment('Notas adicionales sobre este contenido en el paquete');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paquete_contenido');
    }
};
