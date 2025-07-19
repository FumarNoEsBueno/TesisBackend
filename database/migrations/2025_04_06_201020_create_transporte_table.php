<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('transporte', function (Blueprint $table) 
        {
            $table->id();
            $table->string('transporte_solicitante')->nullable();
            $table->string('transporte_desde');
            $table->string('transporte_hacia');
            $table->string('transporte_cuando');
            $table->string('transporte_hora')->nullable();;
            $table->string('transporte_descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transporte');
    }
};
