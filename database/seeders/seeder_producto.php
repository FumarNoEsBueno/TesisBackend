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
        ]);

    }
}
