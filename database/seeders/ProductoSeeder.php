<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $items = [
            [
                'tipo_objeto' => 'cargador',
                'id_objeto'   => 1,                
                'user_id'     => 1,
                'estado_id'   => 1,
                'fecha'       => Carbon::now()->subDays(10)->toDateString(),
                'hora'        => '10:00',
                'descripcion' => 'Cargador universal 60W',
                'peso'        => 0.3,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'tipo_objeto' => 'disco duro',
                'id_objeto'   => 2,                
                'user_id'     => 2,
                'estado_id'   => 2,
                'fecha'       => Carbon::now()->subDays(5)->toDateString(),
                'hora'        => '12:30',
                'descripcion' => 'HDD 1TB SATA 2.5"',
                'peso'        => 0.45,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'tipo_objeto' => 'periferico',
                'id_objeto'   => 3,                
                'user_id'     => 1,
                'estado_id'   => 3,
                'fecha'       => Carbon::now()->subDays(2)->toDateString(),
                'hora'        => '09:15',
                'descripcion' => 'Mouse inalámbrico Logitech',
                'peso'        => 0.2,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'tipo_objeto' => 'periferico',
                'id_objeto'   => 4,
                'user_id'     => 1,
                'estado_id'   => 3,
                'fecha'       => Carbon::now()->subDays(2)->toDateString(),
                'hora'        => '09:30',
                'descripcion' => 'Monoauricular Bluetooth',
                'peso'        => 0.25,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'tipo_objeto' => 'cargador',
                'id_objeto'   => 5,
                'user_id'     => 2,
                'estado_id'   => 1,
                'fecha'       => Carbon::now()->subDay()->toDateString(),
                'hora'        => '14:00',
                'descripcion' => 'Cargador de laptop Dell',
                'peso'        => 0.5,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'tipo_objeto' => 'disco duro',
                'id_objeto'   => 6,
                'user_id'     => 3,
                'estado_id'   => 2,
                'fecha'       => Carbon::now()->subDays(3)->toDateString(),
                'hora'        => '16:45',
                'descripcion' => 'SSD 500GB NVMe',
                'peso'        => 0.1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'tipo_objeto' => 'periferico',
                'id_objeto'   => 7,
                'user_id'     => 1,
                'estado_id'   => 3,
                'fecha'       => $now->toDateString(),
                'hora'        => $now->toTimeString(),
                'descripcion' => 'Teclado mecánico RGB',
                'peso'        => 1.0,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'tipo_objeto' => 'cargador',
                'id_objeto'   => 8,
                'user_id'     => 2,
                'estado_id'   => 1,
                'fecha'       => $now->toDateString(),
                'hora'        => $now->toTimeString(),
                'descripcion' => 'Cargador de teléfono Samsung',
                'peso'        => 0.15,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'tipo_objeto' => 'disco duro',
                'id_objeto'   => 9,
                'user_id'     => 3,
                'estado_id'   => 2,
                'fecha'       => $now->toDateString(),
                'hora'        => $now->toTimeString(),
                'descripcion' => 'HDD externo 2TB',
                'peso'        => 0.8,
                'created_at'  => $now,
                'updated_at'  => $now,
            ]
        ];

        DB::table('producto')->insert($items);
    }
}
