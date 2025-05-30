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
        Schema::create('residuo', function (Blueprint $table) 
        {
            $table->id();
            $table->string('nombre');
            $table->date('fecha');//fecha de ingreso
            $table->string('hora');
            $table->text('descripcion');
            $table->float('peso');
            
            // almacenado en
            $table->foreignId('almacen_id')
                ->constrained('almacen')                // asume tabla 'almacens' o ajusta con ->constrained('almacen')
                ->cascadeOnDelete();

            // ingresado por
            $table->foreignId('users_id')
                ->constrained('users')       // tabla real 'users'
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residuo');
    }
};
