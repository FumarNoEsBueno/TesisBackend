<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\estado;

class seeder_estado extends Seeder
{
    public function run(): void
    {
        $estados = [//almacena los estados de los productos
            ['Nuevo','nuevo'],
            ['Usado','usado'],
            ['Para repuesto','repuesto'],
            ['Por revisar','revisar']
        ];

        $estados = array_map(function ($estado) {
            return [
                'estado_nombre' => $estado[0],
                'estado_descripcion' => $estado[1],
            ];
        }, $estados);

        estado::insert($estados);
    }
}
