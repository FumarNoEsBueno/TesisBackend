<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitud_recepcion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('solicitud_recepcion_volumen_aproximado');
            $table->string('solicitud_recepcion_peso_aproximado');
            $table->string('solicitud_recepcion_peso_calculado')->nullable();
            $table->string('solicitud_recepcion_volumen_calculado')->nullable();
            $table->string('solicitud_recepcion_codigo');
            $table->string('solicitud_recepcion_descripcion')->nullable();
            $table->unsignedBigInteger('metodo_despacho_id');
            $table->unsignedBigInteger('recepcion_estado_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('metodo_despacho_id')->references('id')->on('metodo_despacho');
            $table->foreign('recepcion_estado_id')->references('id')->on('recepcion_estado');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitud_recepcion');
    }
};
