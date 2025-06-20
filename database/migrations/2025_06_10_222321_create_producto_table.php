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
        Schema::create('producto', function (Blueprint $table) {
            $table->id();
            // Tipo de producto: disco duro, ram, cargador, periferico, etc.
            $table->string('tipo');
            $table->unsignedBigInteger('id_objeto');

            $table->date('fecha');
            $table->string('hora');
            $table->text('descripcion');
            $table->float('peso');
            
            $table->foreignId('almacen_id')
                ->constrained('almacen')
                ->cascadeOnDelete();

            $table->foreignId('users_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('estado_id') 
                ->constrained('estado')
                ->cascadeOnDelete();
            
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
