<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('velocidad_ram', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('velocidad_ram_velocidad');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('velocidad_ram');
    }
};
