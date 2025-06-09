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
            $table->unsignedBigInteger('id_paquete');
            $table->enum('tipo_contenido', ['viaje', 'hospedaje', 'vehiculo']);
            $table->unsignedBigInteger('id_contenido');
            $table->foreign('id_paquete')->references('id')->on('paquetes')->onDelete('cascade');
            $table->timestamps();
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
