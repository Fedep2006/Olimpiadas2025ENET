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
        Schema::create('reservas_viaje', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_viaje')->constrained('viajes')->onDelete('cascade');
            $table->timestamp('fecha_reserva')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas_viaje');
    }
};
