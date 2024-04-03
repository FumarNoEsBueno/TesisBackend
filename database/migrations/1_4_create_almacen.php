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
        Schema::create('almacen', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('almacen_nombre');
            $table->unsignedBigInteger('direccion_id');
            $table->foreign('direccion_id')->references('id')->on('direccion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('almacen');
    }
};
