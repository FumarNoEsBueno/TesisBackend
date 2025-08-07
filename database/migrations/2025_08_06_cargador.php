<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cargador', function (Blueprint $table) {
            $table->id();            
            
            $table->foreignId('almacen_id')->constrained('almacen')->onDelete('cascade');

            $table->string('modelo')->nullable();
            $table->string('marca')->nullable();
            $table->string('input')->nullable();
            $table->string('output')->nullable();
            $table->string('amp')->nullable();
            $table->string('diametro_od_id')->nullable();
            $table->string('largo_punta')->nullable();
            $table->boolean('disponibilidad')->default(true);
            $table->boolean('test')->nullable();
            $table->float('largo_m')->nullable();
            $table->text('descripcion_punta')->nullable();
            $table->integer('precio_unitario')->nullable();
            $table->integer('precio_volumen')->nullable();
            $table->timestamps();
        });
        
    }


    public function down(): void
    {
        Schema::dropIfExists('cargador');
    }
};
