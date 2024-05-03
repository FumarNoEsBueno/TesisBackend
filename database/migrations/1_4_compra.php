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
        Schema::create('compra', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('compra_codigo');
            $table->string('compra_email');
            $table->string('direccion_id')->nullable();
            $table->string('metodo_pago_id')->nullable();
            $table->string('metodo_despacho_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra');
    }
};
