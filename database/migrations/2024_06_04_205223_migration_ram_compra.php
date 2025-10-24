<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ram_compra', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('ram_id');
            $table->unsignedBigInteger('compra_id');
            $table->integer('ram_compra_descuento')->nullable();

            $table->foreign('ram_id')->references('id')->on('ram');
            $table->foreign('compra_id')->references('id')->on('compra');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ram_compra');
    }
};
