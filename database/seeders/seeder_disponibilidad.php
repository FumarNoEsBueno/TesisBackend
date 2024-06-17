<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\disponibilidad;

class seeder_disponibilidad extends Seeder
{
    public function run(): void
    {
        $disponibilidades = [
            ['En bodega','Descripcion'],
            ['Reparacion pendiente','Descripcion'],
            ['Reservado','Descripcion'],
            ['Vendido','Descripcion']
        ];

        $disponibilidades = array_map(function ($disponibilidad) {
            return [
                'disponibilidad_nombre' => $disponibilidad[0],
                'disponibilidad_descripcion' => $disponibilidad[1],
            ];
        }, $disponibilidades);

        disponibilidad::insert($disponibilidades);
    }
}
