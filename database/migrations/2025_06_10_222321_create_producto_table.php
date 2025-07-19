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
        Schema::create('producto', function (Blueprint $table) 
        {
            $table->id();
            // Tipo de producto: disco duro, ram, cargador, periferico, etc.
            $table->string('tipo_objeto');
            $table->unsignedBigInteger('id_objeto')->nullable();

            $table->date('fecha');
            $table->time('hora');

            $table->text('descripcion');
            $table->float('peso');
                        
            $table->foreignId('user_id')
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
