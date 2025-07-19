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
            $table->integer('compra_costo');
            $table->date('compra_garantia')->nullable();

            $table->unsignedBigInteger('estado_compra_id')->nullable();
            $table->unsignedBigInteger('direccion_id')->nullable();
            $table->unsignedBigInteger('metodo_pago_id');
            $table->unsignedBigInteger('metodo_despacho_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('estado_compra_id')->references('id')->on('estado_compra');
            $table->foreign('direccion_id')->references('id')->on('direccion');
            $table->foreign('metodo_pago_id')->references('id')->on('metodo_pago');
            $table->foreign('metodo_despacho_id')->references('id')->on('metodo_despacho');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compra');
    }
};
