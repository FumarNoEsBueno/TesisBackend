<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('compra', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('compra_codigo');
            $table->string('compra_email');
            $table->string('compra_direccion');

            $table->unsignedBigInteger('ciudad_id')->nullable();
            $table->unsignedBigInteger('metodo_pago_id');
            $table->unsignedBigInteger('metodo_despacho_id');

            $table->foreign('ciudad_id')->references('id')->on('ciudad');
            $table->foreign('metodo_pago_id')->references('id')->on('metodo_pago');
            $table->foreign('metodo_despacho_id')->references('id')->on('metodo_despacho');
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
