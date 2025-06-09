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
        Schema::create('compras_paquetes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_paquete')->constrained('paquetes')->onDelete('cascade');
            $table->unsignedBigInteger('id_paquete');
            $table->timestamp('fecha_compra')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras_paquetes');
    }
};
