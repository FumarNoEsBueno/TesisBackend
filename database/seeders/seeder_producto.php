<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class seeder_producto extends Seeder
{
    public function run(): void
    {
        
        DB::table('producto')->insert([
            [
                'tipo' => 'cargador',
                'id_objeto' => 1,
                'almacen_id' => 1,
                'users_id' => 1,
                'estado_id' => 1,
                'fecha' => Carbon::now()->subDays(10)->toDateString(),
                'hora' => '10:00',
                'descripcion' => 'Cargador universal 60W',
                'peso' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo' => 'disco duro',
                'id_objeto' => 2,
                'almacen_id' => 1,
                'users_id' => 2,
                'estado_id' => 2,
                'fecha' => Carbon::now()->subDays(5)->toDateString(),
                'hora' => '12:30',
                'descripcion' => 'HDD 1TB SATA 2.5"',
                'peso' => 0.45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo' => 'periferico',
                'id_objeto' => 3,
                'almacen_id' => 2,
                'users_id' => 1,
                'estado_id' => 3,
                'fecha' => Carbon::now()->subDays(2)->toDateString(),
                'hora' => '09:15',
                'descripcion' => 'Mouse inalámbrico Logitech',
                'peso' => 0.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo' => 'periferico',
                'id_objeto' => 3,
                'almacen_id' => 2,
                'users_id' => 1,
                'estado_id' => 3,
                'fecha' => Carbon::now()->subDays(2)->toDateString(),
                'hora' => '09:15',
                'descripcion' => 'Monoauricular Bluetooth',
                'peso' => 0.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo' => 'cargador',
                'id_objeto' => 4,
                'almacen_id' => 3,
                'users_id' => 2,
                'estado_id' => 1,
                'fecha' => Carbon::now()->subDays(1)->toDateString(),
                'hora' => '14:00',
                'descripcion' => 'Cargador de laptop Dell',
                'peso' => 0.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo' => 'disco duro',
                'id_objeto' => 5,
                'almacen_id' => 3,
                'users_id' => 3,
                'estado_id' => 2,
                'fecha' => Carbon::now()->subDays(3)->toDateString(),
                'hora' => '16:45',
                'descripcion' => 'SSD 500GB NVMe',
                'peso' => 0.1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo' => 'periferico',
                'id_objeto' => 6,
                'almacen_id' => 1,
                'users_id' => 1,
                'estado_id' => 3,
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'descripcion' => 'Teclado mecánico RGB',
                'peso' => 1.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo' => 'cargador',
                'id_objeto' => 7,
                'almacen_id' => 2,
                'users_id' => 2,
                'estado_id' => 1,
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'descripcion' => 'Cargador de teléfono Samsung',
                'peso' => 0.15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo' => 'disco duro',
                'id_objeto' => 8,
                'almacen_id' => 3,
                'users_id' => 3,
                'estado_id' => 2,
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'descripcion' => 'HDD externo 2TB',
                'peso' => 0.8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Generar 15 cables con fecha y hora actuales
        $nowDate = Carbon::now()->toDateString();
        $nowTime = Carbon::now()->toTimeString();

        $base = [
            [
                'tipo' => 'cargador',
                'id_objeto' => 1,
                'almacen_id' => 1,
                'users_id' => 1,
                'estado_id' => 1,
                'fecha' => Carbon::now()->subDays(10)->toDateString(),
                'hora' => '10:00',
                'descripcion' => 'Cargador universal 60W',
                'peso' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ... otras entradas existentes ...
        ];

        $cables = array_map(function ($id) use ($nowDate, $nowTime) {
            return [
                'tipo' => 'cable',
                'id_objeto' => $id,
                'almacen_id' => 1,
                'users_id' => 1,
                'estado_id' => 1,
                'fecha' => $nowDate,
                'hora' => $nowTime,
                'descripcion' => 'Referencia a Cable ID ' . $id,
                'peso' => 0.1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, range(1, 15));

        DB::table('producto')->insert(array_merge($base, $cables));


    }
}
