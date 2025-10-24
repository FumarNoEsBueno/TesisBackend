<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estado_compra', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('estado_compra_nombre');
            $table->string('estado_compra_slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estado_compra');
    }
};
