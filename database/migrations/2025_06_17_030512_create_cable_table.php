<?php
// database/migrations/xxxx_xx_xx_xxxxxx_update_cable_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('cable', function (Blueprint $table) {
            // Quitar cantidad
            $table->dropColumn('cable_cantidad');

            // Nuevos campos
                $table->text('comentario')->nullable();
                $table->string('test')->nullable();
                $table->float('largo', 8, 2)->nullable();
                $table->text('descripcion')->nullable();
                $table->integer('cable_precio_unitario');
                $table->integer('cable_precio_final');                
        });
    }

    public function down(): void
    {
        Schema::table('cable', function (Blueprint $table) {
            // Revertir cambios
            $table->dropColumn([
                'comentario','test','largo','descripcion',
                'cable_precio_unitario','cable_precio_final','cable_foto'
            ]);

            $table->binary('cable_foto')->nullable()->after('cable_precio');
            $table->integer('cable_cantidad')->after('cable_nombre');
        });
    }
};
