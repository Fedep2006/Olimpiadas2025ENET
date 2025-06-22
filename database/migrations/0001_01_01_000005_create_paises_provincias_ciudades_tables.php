<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tabla de países
        Schema::create('paises', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->timestamps();
        });

        // Tabla de provincias
        Schema::create('provincias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->foreignId('id_pais')->constrained('paises')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabla de ciudades
        Schema::create('ciudades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->foreignId('id_provincia')->constrained('provincias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ciudades');
        Schema::dropIfExists('provincias');
        Schema::dropIfExists('paises');
    }
};
