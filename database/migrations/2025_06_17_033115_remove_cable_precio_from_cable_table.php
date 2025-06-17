<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('cable', function (Blueprint $table) {
            $table->dropColumn('cable_precio');
        });
    }

    public function down()
    {
        Schema::table('cable', function (Blueprint $table) {
            $table->integer('cable_precio')->nullable(false);
        });
    }

};
