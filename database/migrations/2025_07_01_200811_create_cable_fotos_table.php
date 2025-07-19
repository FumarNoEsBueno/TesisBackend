<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cable_fotos', function (Blueprint $table) 
        {
            $table->id();
            $table->foreignId('cable_id')
                ->constrained('cable')
                ->cascadeOnDelete();
            $table->string('nombre_archivo');
            $table->string('ruta');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('cable_fotos');
    }

};
