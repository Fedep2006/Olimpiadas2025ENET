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
        Schema::create('reserva_hospedajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hospedaje_id')->constrained('hospedajes');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('pago_id')->constrained('pagos');
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            $table->integer('cantidad_personas');
            $table->decimal('precio_por_noche', 10, 2);
            $table->decimal('monto_total', 12, 2);
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada', 'completada'])->default('pendiente');
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva_hospedajes');
    }
};
