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
        Schema::create('reparacion', function (Blueprint $table) 
        {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->enum('tipo_reparado', ['residuo', 'producto', 'herramienta']);
            $table->unsignedBigInteger('id_reparado');
            $table->string('detalle_reparacion');
            $table->text('observaciones')->nullable();
            $table->date('fecha_reparacion');
            $table->timestamps();


            $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reparacion');
    }
};
