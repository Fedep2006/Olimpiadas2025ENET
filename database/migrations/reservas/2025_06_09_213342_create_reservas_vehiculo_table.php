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
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->onDelete('cascade');
            $table->dateTime('fecha_recogida')->comment('Fecha y hora programada para la recogida del vehículo');
            $table->dateTime('fecha_devolucion')->comment('Fecha y hora programada para la devolución del vehículo');
            $table->string('ubicacion_recogida')->comment('Dirección o punto donde se recogerá el vehículo');
            $table->string('ubicacion_devolucion')->comment('Dirección o punto donde se devolverá el vehículo');
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada', 'completada'])->default('pendiente')
                ->comment('Estado actual de la reserva: pendiente (recién creada), confirmada (pago verificado), cancelada (anulada), completada (vehículo devuelto)');
            $table->integer('cantidad_pasajeros')->comment('Número total de personas que viajarán en el vehículo');
            $table->decimal('precio_total', 10, 2)->comment('Precio total de la reserva en la moneda base del sistema');
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
        Schema::dropIfExists('reservas_vehiculo');
    }
};
