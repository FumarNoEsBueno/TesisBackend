<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\Almacen;
use Illuminate\Support\Facades\DB;

class AlmacenSeeder extends Seeder
{
    public function run(): void
    {
        $almacen = [
            ['almacen Nonguen', 1],
            ['almacen Hualpen', 2],
            ['Casa del Naufrago', 3]
        ];

        $datos = array_map(fn($a) => [
            'almacen_nombre' => $a[0],
            'direccion_id'   => $a[1]
        ], $almacen);

        Almacen::insert($datos);
    }
}
