<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('CapacidadRam', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('CapacidadRam_capacidad');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('CapacidadRam');
    }
};
