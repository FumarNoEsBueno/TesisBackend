<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Disponibilidad;

class DisponibilidadSeeder extends Seeder
{
    public function run(): void
    {
        $disponibilidad = [
            ['En bodega','Descripcion'],
            ['Reparacion pendiente','Descripcion'],
            ['Vendido','Descripcion']
        ];

        $disponibilidad = array_map(function ($disponibilidad) {
            return [
                'disponibilidad_nombre' => $disponibilidad[0],
                'disponibilidad_descripcion' => $disponibilidad[1],
            ];
        }, $disponibilidad);

        Disponibilidad::insert($disponibilidad);
    }
}
