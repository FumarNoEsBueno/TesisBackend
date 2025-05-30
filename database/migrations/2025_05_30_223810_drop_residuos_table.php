<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('residuos');
    }

    public function down(): void
    {
        // Opcional: si quieres recrearla, copia aquí el esquema original:
        Schema::create('residuos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('almacenado_en');
            $table->date('fecha_ingreso');
            $table->string('ingresado_por');
            $table->timestamps();
        });
    }
};
