<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('periferico_compra', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('periferico_id');
            $table->unsignedBigInteger('compra_id');
            $table->unsignedBigInteger('descuento_id')->nullable();

            $table->foreign('descuento_id')->references('id')->on('descuento');
            $table->foreign('periferico_id')->references('id')->on('periferico');
            $table->foreign('compra_id')->references('id')->on('compra');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periferico_compra');
    }
};
