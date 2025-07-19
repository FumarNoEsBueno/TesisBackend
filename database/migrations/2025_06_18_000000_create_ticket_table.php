<?php
// database/migrations/2025_06_18_000000_create_ticket_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTable extends Migration
{
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) 
        {
            $table->id();
            $table->text('mensaje');
            $table->unsignedBigInteger('user_id'); // quien lo dejó
            $table->unsignedBigInteger('estado_id');//estado del ticket (abierto, cerrado, etc.)
            $table->timestamps(); // created_at y updated_at (cuándo)

            // Claves foráneas
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('estado_id')->references('id')->on('estado');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ticket');
    }
}