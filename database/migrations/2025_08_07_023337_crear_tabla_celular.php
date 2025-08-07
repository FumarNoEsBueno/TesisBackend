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
        Schema::create('celular', function (Blueprint $table) {
        $table->id();
        
        $table->string('marca')->nullable();
        $table->string('modelo')->nullable();
        $table->string('nombre_modelo')->nullable();
        $table->string('memoria_interna')->nullable();
        $table->string('resolucion')->nullable();
        $table->string('condicion_pantalla')->nullable();
        $table->boolean('disponibilidad')->default(true);
        $table->string('estado')->nullable();
        $table->boolean('test')->nullable();
        $table->foreignId('almacen_id')->constrained('almacen')->onDelete('cascade');
        $table->string('entrada')->nullable();
        $table->text('comentarios')->nullable();
        $table->integer('precio_venta')->nullable();
        $table->string('imagen')->nullable();
        $table->string('numero_modelo')->nullable();
        $table->string('numero_serie')->nullable();
        $table->string('imei_1')->nullable();
        $table->string('imei_2')->nullable();
        
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
