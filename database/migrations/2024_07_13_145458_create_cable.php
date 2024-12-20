<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cable', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('cable_nombre');
            $table->integer('cable_cantidad');
            $table->integer('cable_precio');
            $table->binary('cable_foto');
            $table->integer('cable_descuento')->nullable();
            $table->boolean('cable_destacado')->default(false);

            $table->unsignedBigInteger('solicitud_recepcion_id')->nullable();
            $table->unsignedBigInteger('disponibilidad_id');
            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('tipo_entrada_id');

            $table->foreign('solicitud_recepcion_id')->references('id')->on('solicitud_recepción');
            $table->foreign('disponibilidad_id')->references('id')->on('disponibilidad');
            $table->foreign('almacen_id')->references('id')->on('almacen');
            $table->foreign('estado_id')->references('id')->on('estado');
            $table->foreign('marca_id')->references('id')->on('marca');
            $table->foreign('tipo_entrada_id')->references('id')->on('tipo_entrada');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cable');
    }
};
