<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seeder_estado extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = [
            ['Nuevo','Descripcion'],
            ['Usado','Descripcion'],
            ['Por revisar','Descripcion']
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
