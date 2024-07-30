<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compra_cable', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('compra_cable_cantidad');
            $table->unsignedBigInteger('cable_id');
            $table->unsignedBigInteger('compra_id');
            $table->unsignedBigInteger('descuento_id')->nullable();

            $table->foreign('descuento_id')->references('id')->on('descuento');
            $table->foreign('cable_id')->references('id')->on('cable');
            $table->foreign('compra_id')->references('id')->on('compra');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compra_cable');
    }
};
