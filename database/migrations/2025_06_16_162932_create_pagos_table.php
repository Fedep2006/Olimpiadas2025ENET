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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehiculo_id')->nullable()->constrained('vehiculos')->onDelete('cascade');
            $table->foreignId('reserva_id')->nullable()->constrained('reservas')->onDelete('cascade');
            $table->foreignId('reserva_viaje_id')->constrained('reservas_viaje')->onDelete('cascade');
            $table->string('estado')->default('pendiente');
            $table->string('cardholder_name');
            $table->string('card_number');
            $table->string('expiration_month', 2);
            $table->string('expiration_year', 4);
            $table->string('cvv', 4);
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
