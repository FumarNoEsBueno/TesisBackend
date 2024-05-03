<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\periferico;

class seeder_periferico extends Seeder
{
    public function run(): void
    {
        $perifericos = [
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1],
            ['Drescripcion del periferico',
            9999,
            1,
            1,
            1,
            1,
            1,
            1]
        ];

        $perifericos = array_map(function ($periferico) {
            return [
                'periferico_nombre' => "",
                'periferico_foto' => 'periferico'.(string)rand(1,3) . '.jpg',
                'periferico_descripcion' => $periferico[0],
                'periferico_precio' => $periferico[1],
                'disponibilidad_id' => $periferico[2],
                'almacen_id' => $periferico[3],
                'estado_id' => $periferico[4],
                'marca_id' => $periferico[5],
                'tipo_entrada_id' => $periferico[6],
                'tipo_periferico_id' => $periferico[7],
            ];
        }, $perifericos);

        periferico::insert($perifericos);
    }
}
