<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\direccion;

class seeder_direccion extends Seeder
{
    public function run(): void
    {
        $direcciones = [
            ['Calle falsa 123',1],
            ['Caller real 321',2],
        ];

        $direcciones = array_map(function ($direccion) {
            return [
                'direccion_nombre' => $direccion[0],
                'ciudad_id' => $direccion[1],
            ];
        }, $direcciones);

        direccion::insert($direcciones);
    }
}
