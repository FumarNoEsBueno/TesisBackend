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
            $table->decimal('cable_precio_unitario', 10, 2)->default(0);           
            $table->decimal('cable_precio_final', 10, 2)->default(0);
            $table->string('cable_foto')->nullable();
            $table->decimal('cable_descuento', 10, 2)->default(0);
            $table->boolean('cable_destacado')->default(false);

            $table->text('comentario')->nullable();
            $table->text('descripcion')->nullable();

            $table->decimal('largo', 8, 2)->nullable();
            $table->boolean('test')->default(false);
            $table->decimal('peso', 8, 2)->nullable();

            // Foraneas
            $table->unsignedBigInteger('solicitud_recepcion_id')->nullable();
            $table->unsignedBigInteger('disponibilidad_id');
            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('marca_id');            
            $table->unsignedBigInteger('tipo_entrada_1_id')->nullable();
            $table->unsignedBigInteger('tipo_entrada_2_id')->nullable();

            // Relaciones
            $table->foreign('solicitud_recepcion_id')->references('id')->on('solicitud_recepcion');
            $table->foreign('disponibilidad_id')->references('id')->on('disponibilidad');
            $table->foreign('almacen_id')->references('id')->on('almacen');
            $table->foreign('estado_id')->references('id')->on('estado');
            $table->foreign('marca_id')->references('id')->on('marca');            
            $table->foreign('tipo_entrada_1_id')->references('id')->on('tipo_entrada');
            $table->foreign('tipo_entrada_2_id')->references('id')->on('tipo_entrada');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cable');
    }
};
