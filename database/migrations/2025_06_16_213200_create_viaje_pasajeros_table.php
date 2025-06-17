<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('viaje_pasajeros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reserva_id')->constrained('reservas')->onDelete('cascade');
            $table->string('nombre');
            $table->string('dni');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('viaje_pasajeros');
    }
};
