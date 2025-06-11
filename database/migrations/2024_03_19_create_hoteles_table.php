<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hoteles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ubicacion');
            $table->string('pais');
            $table->integer('estrellas');
            $table->integer('habitaciones');
            $table->string('tipos_habitacion');
            $table->decimal('precio_por_noche', 10, 2);
            $table->boolean('disponibilidad')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hoteles');
    }
}; 