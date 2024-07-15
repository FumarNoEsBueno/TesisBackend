<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ram', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('ram_nombre');
            $table->string('ram_descripcion');
            $table->binary('ram_foto');
            $table->integer('ram_precio');
            $table->unsignedBigInteger('descuento_id')->nullable();
            $table->unsignedBigInteger('disponibilidad_id');
            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('tipo_ram_id');
            $table->unsignedBigInteger('capacidad_ram_id');
            $table->unsignedBigInteger('tamano_ram_id');
            $table->unsignedBigInteger('velocidad_ram_id');

            $table->foreign('descuento_id')->references('id')->on('descuento');
            $table->foreign('disponibilidad_id')->references('id')->on('disponibilidad');
            $table->foreign('almacen_id')->references('id')->on('almacen');
            $table->foreign('estado_id')->references('id')->on('estado');
            $table->foreign('marca_id')->references('id')->on('marca');
            $table->foreign('tipo_ram_id')->references('id')->on('tipo_ram');
            $table->foreign('capacidad_ram_id')->references('id')->on('capacidad_ram');
            $table->foreign('tamano_ram_id')->references('id')->on('tamano_ram');
            $table->foreign('velocidad_ram_id')->references('id')->on('velocidad_ram');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ram');
    }
};
