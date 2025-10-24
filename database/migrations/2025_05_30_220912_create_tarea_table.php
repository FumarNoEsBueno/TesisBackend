<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('tarea', function (Blueprint $table) 
    {
        $table->id();
        $table->string('nombre');
        $table->text('descripcion')->nullable();
        $table->string('tipo_trabajo'); // Ej: clasificador, destructor, administrador
        $table->string('nivel_urgencia'); // Ej: bajo, medio, alto
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarea');
    }
};
