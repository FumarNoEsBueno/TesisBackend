<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disco_duro_compra', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('disco_duro_id');
            $table->unsignedBigInteger('compra_id');
            $table->integer('disco_duro_compra_descuento')->nullable();

            $table->foreign('disco_duro_id')->references('id')->on('disco_duro');
            $table->foreign('compra_id')->references('id')->on('compra');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disco_duro_compra');
    }
};
