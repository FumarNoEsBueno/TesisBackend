<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UpgradeoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('upgradeo')->insert([
            [
                'user_id'           => 1,
                'tipo_objeto'       => 'residuo',
                'id_objeto'         => 10,
                'detalle_upgradeo'  => 'Optimización de valor reciclado',
                'observaciones'     => 'Proceso ajustado para mayor pureza',
                'fecha_upgradeo'    => Carbon::now()->subDays(3),
                'created_at'        => Carbon::now()->subDays(3),
                'updated_at'        => Carbon::now()->subDays(3),
            ],
            [
                'user_id'           => 2,
                'tipo_objeto'       => 'producto',
                'id_objeto'         => 5,
                'detalle_upgradeo'  => 'Mejora de rendimiento',
                'observaciones'     => 'Configuración de parámetros optimizada',
                'fecha_upgradeo'    => Carbon::now()->subDays(7),
                'created_at'        => Carbon::now()->subDays(7),
                'updated_at'        => Carbon::now()->subDays(7),
            ],
            [
                'user_id'           => 3,
                'tipo_objeto'       => 'herramienta',
                'id_objeto'         => 3,
                'detalle_upgradeo'  => 'Refuerzo de estructura',
                'observaciones'     => 'Se añadió recubrimiento anticorrosión',
                'fecha_upgradeo'    => Carbon::now()->subDays(15),
                'created_at'        => Carbon::now()->subDays(15),
                'updated_at'        => Carbon::now()->subDays(15),
            ],
        ]);
    }
}
