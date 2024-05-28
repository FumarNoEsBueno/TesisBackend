<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('metodo_despacho', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('metodo_despacho_nombre');
            $table->string('metodo_despacho_slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metodo_despacho');
    }
};
