<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ReparacionSeeder extends Seeder
{
    public function run()
    {
        DB::table('reparacion')->insert([
            [
                'user_id' => 1,
                'tipo_objeto' => 'residuo',
                'id_objeto' => 10,
                'detalle_reparacion' => 'Reparación de filtración',
                'observaciones' => 'Se usó sellador especial',
                'fecha_reparacion' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'user_id' => 2,
                'tipo_objeto' => 'producto',
                'id_objeto' => 5,
                'detalle_reparacion' => 'Reemplazo de pieza dañada',
                'observaciones' => 'Pieza original no disponible, se usó alternativa',
                'fecha_reparacion' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'user_id' => 3,
                'tipo_objeto' => 'herramienta',
                'id_objeto' => 3,
                'detalle_reparacion' => 'Afilado de cuchilla',
                'observaciones' => 'Se afiló con piedra especial',
                'fecha_reparacion' => Carbon::now()->subDays(10),
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(10),
            ],
            [
                'user_id' => 1,
                'tipo_objeto' => 'residuo',
                'id_objeto' => 7,
                'detalle_reparacion' => 'Limpieza profunda',
                'observaciones' => 'Se usaron productos biodegradables',
                'fecha_reparacion' => Carbon::now()->subDays(1),
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'user_id' => 2,
                'tipo_objeto' => 'herramienta',
                'id_objeto' => 8,
                'detalle_reparacion' => 'Cambio de mango',
                'observaciones' => 'Mango de madera reemplazado',
                'fecha_reparacion' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
