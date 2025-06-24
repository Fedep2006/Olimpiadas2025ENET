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
        Schema::table('paquetes', function (Blueprint $table) {
            $table->string('duracion')->nullable()->change();
            $table->string('ubicacion')->nullable()->change();
            $table->integer('cupo_minimo')->nullable()->change();
            $table->integer('cupo_maximo')->nullable()->change();
            $table->string('numero_paquete')->nullable()->change();
            $table->boolean('hecho_por_usuario')->nullable()->change();
            $table->boolean('activo')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paquetes', function (Blueprint $table) {
            $table->string('duracion')->nullable(false)->change();
            $table->string('ubicacion')->nullable(false)->change();
            $table->integer('cupo_minimo')->nullable(false)->change();
            $table->integer('cupo_maximo')->nullable(false)->change();
            $table->string('numero_paquete')->nullable(false)->change();
            $table->boolean('hecho_por_usuario')->nullable(false)->change();
            $table->boolean('activo')->nullable(false)->change();
        });
    }
};
