<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('periferico', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('periferico_nombre');
            $table->string('periferico_descripcion');
            $table->integer('periferico_precio');
            $table->binary('periferico_foto');
            $table->integer('periferico_descuento')->nullable();
            $table->boolean('periferico_destacado')->default(false);

            $table->unsignedBigInteger('solicitud_recepcion_id')->nullable();
            $table->unsignedBigInteger('disponibilidad_id');
            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('tipo_entrada_id');
            $table->unsignedBigInteger('tipo_periferico_id');

            $table->foreign('solicitud_recepcion_id')->references('id')->on('solicitud_recepcion');
            $table->foreign('disponibilidad_id')->references('id')->on('disponibilidad');
            $table->foreign('almacen_id')->references('id')->on('almacen');
            $table->foreign('estado_id')->references('id')->on('estado');
            $table->foreign('marca_id')->references('id')->on('marca');
            $table->foreign('tipo_entrada_id')->references('id')->on('tipo_entrada');
            $table->foreign('tipo_periferico_id')->references('id')->on('tipo_periferico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periferico');
    }
};
