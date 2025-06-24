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
        Schema::table('reservas', function (Blueprint $table) {
            // Make paquete_id nullable and add polymorphic columns
            $table->foreignId('paquete_id')->nullable()->change();
            $table->unsignedBigInteger('reservable_id')->nullable()->after('paquete_id');
            $table->string('reservable_type')->nullable()->after('reservable_id');
            $table->index(['reservable_id', 'reservable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            // Drop polymorphic columns and make paquete_id not nullable again
            $table->dropIndex(['reservable_id', 'reservable_type']);
            $table->dropColumn(['reservable_id', 'reservable_type']);
            $table->foreignId('paquete_id')->nullable(false)->change();
        });
    }
};
