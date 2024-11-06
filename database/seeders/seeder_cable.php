<?php

namespace Database\Seeders;

use App\Models\cable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seeder_cable extends Seeder
{
    public function run(): void
    {
        $cables = [
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1],
            ['Drescripcion de la ram',
            1]
];
        $cables = array_map(function ($cable) {
            return [
                'cable_nombre' => "Cable pulento",
                'cable_precio' => rand(1,100)*500 + 10000,
                'cable_cantidad' => rand(5,100),
                'cable_foto' => 'cable_'.(string)rand(1,4) . '.jpg',
                'disponibilidad_id' => rand(1,2),
                'almacen_id' => 1,
                'estado_id' => rand(1,3),
                'marca_id' => rand(1,7),
                'tipo_entrada_id' => rand(1,7),
            ];
        }, $cables);

        cable::insert($cables);
    }
}
