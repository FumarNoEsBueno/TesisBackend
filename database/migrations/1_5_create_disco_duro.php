<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disco_duro', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('disco_duro_memoria');
            $table->string('disco_duro_nombre');
            $table->binary('disco_duro_foto');
            $table->binary('disco_duro_crystaldisk');
            $table->string('disco_duro_horas_encendido');
            $table->string('disco_duro_esperanza_vida');
            $table->integer('disco_duro_precio');
            $table->integer('disco_duro_descuento')->nullable();
            $table->boolean('disco_duro_destacado')->default(false);

            $table->unsignedBigInteger('solicitud_recepcion_id')->nullable();
            $table->unsignedBigInteger('disponibilidad_id');
            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('tamano_id');
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('sistema_archivos_id');
            $table->unsignedBigInteger('tipo_entrada_id');

            $table->foreign('solicitud_recepcion_id')->references('id')->on('solicitud_recepcion');
            $table->foreign('disponibilidad_id')->references('id')->on('disponibilidad');
            $table->foreign('almacen_id')->references('id')->on('almacen');
            $table->foreign('estado_id')->references('id')->on('estado');
            $table->foreign('tamano_id')->references('id')->on('tamano');
            $table->foreign('marca_id')->references('id')->on('marca');
            $table->foreign('sistema_archivos_id')->references('id')->on('sistema_archivos');
            $table->foreign('tipo_entrada_id')->references('id')->on('tipo_entrada');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disco_duro');
    }
};
