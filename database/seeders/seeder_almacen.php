<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seeder_almacen extends Seeder
{
    public function run(): void
    {
        $almacenes = [
            ['Casa del Jean', 0],
            ['Casa del Diego', 1]
        ];

        $almacenes = array_map(function ($almacen) {
            return [
                'almacen_nombre' => $almacen[0],
                'direccion_id' => $almacen[1]
            ];
        }, $almacenes);

        almacen::insert($almacenes);
    }
}
