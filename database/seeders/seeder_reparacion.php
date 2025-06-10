<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class seeder_reparacion extends Seeder
{
    public function run()
    {
        DB::table('reparacion')->insert([
            [
                'id_usuario' => 1,
                'tipo_reparado' => 'residuo',
                'id_reparado' => 10,
                'detalle_reparacion' => 'Reparación de filtración',
                'observaciones' => 'Se usó sellador especial',
                'fecha_reparacion' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'id_usuario' => 2,
                'tipo_reparado' => 'producto',
                'id_reparado' => 5,
                'detalle_reparacion' => 'Reemplazo de pieza dañada',
                'observaciones' => 'Pieza original no disponible, se usó alternativa',
                'fecha_reparacion' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'id_usuario' => 3,
                'tipo_reparado' => 'herramienta',
                'id_reparado' => 3,
                'detalle_reparacion' => 'Afilado de cuchilla',
                'observaciones' => 'Se afiló con piedra especial',
                'fecha_reparacion' => Carbon::now()->subDays(10),
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(10),
            ],
            [
                'id_usuario' => 1,
                'tipo_reparado' => 'residuo',
                'id_reparado' => 7,
                'detalle_reparacion' => 'Limpieza profunda',
                'observaciones' => 'Se usaron productos biodegradables',
                'fecha_reparacion' => Carbon::now()->subDays(1),
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'id_usuario' => 2,
                'tipo_reparado' => 'herramienta',
                'id_reparado' => 8,
                'detalle_reparacion' => 'Cambio de mango',
                'observaciones' => 'Mango de madera reemplazado',
                'fecha_reparacion' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
