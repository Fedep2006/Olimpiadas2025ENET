<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reservas_viaje', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('viaje_id')->constrained('viajes')->onDelete('cascade');
            $table->integer('cantidad');
            $table->json('pasajeros');
            $table->decimal('precio_total', 10, 2);
            $table->string('estado')->default('pendiente');
            $table->string('metodo_pago')->nullable();
            $table->boolean('pagado')->default(false);
            $table->timestamp('fecha_pago')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservas_viaje');
    }
};
