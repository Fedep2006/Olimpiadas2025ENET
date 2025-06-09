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
        Schema::create('reservas_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_vehiculo')->constrained('vehiculos')->onDelete('cascade');
            $table->unsignedBigInteger('id_vehiculo');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas_vehiculo');
    }
};
