<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paquete_contenido', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paquete_id')->constrained('paquetes')->onDelete('cascade')
                ->comment('ID del paquete turístico al que pertenece este contenido');
            $table->morphs('contenido');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['paquete_id', 'contenido_type', 'contenido_id'], 'unique_paquete_contenido');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paquete_contenido');
    }
};
