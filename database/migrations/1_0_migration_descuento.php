<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('descuento', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('descuento_porcentaje');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('descuento');
    }
};
