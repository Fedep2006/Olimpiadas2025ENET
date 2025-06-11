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
        Schema::create('reservas_paquetes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade')
                ->comment('ID del usuario que realiza la reserva');
            $table->foreignId('paquete_id')->constrained('paquetes')->onDelete('cascade')
                ->comment('ID del paquete turístico reservado');
            $table->dateTime('fecha_inicio')->comment('Fecha y hora de inicio del paquete turístico');
            $table->dateTime('fecha_fin')->comment('Fecha y hora de finalización del paquete turístico');
            $table->string('ubicacion_paquete')->comment('Ubicación principal o punto de encuentro del paquete');
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada', 'completada'])->default('pendiente')
                ->comment('Estado actual de la reserva: pendiente (recién creada), confirmada (pago verificado), cancelada (anulada), completada (paquete realizado)');
            $table->json('personas_id')->comment('Array de IDs de la tabla personas que participarán en el paquete');
            $table->decimal('precio_total', 10, 2)->comment('Precio total del paquete en la moneda base del sistema');
            $table->string('codigo_reserva', 8)->unique()->comment('Código único de 8 caracteres para identificar la reserva');
            $table->text('observaciones')->nullable()->comment('Notas adicionales sobre la reserva o requerimientos especiales');
            $table->string('metodo_pago')->nullable()->comment('Método de pago utilizado (efectivo, tarjeta, transferencia, etc.)');
            $table->boolean('pagado')->default(false)->comment('Indica si la reserva ha sido pagada completamente');
            $table->date('fecha_pago')->nullable()->comment('Fecha en que se realizó el pago de la reserva');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas_paquetes');
    }
};
