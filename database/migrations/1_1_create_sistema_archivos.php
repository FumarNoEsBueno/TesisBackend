<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sistema_archivos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('sistema_archivos_nombre');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sistema_archivos');
    }
};
