<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tamano;

class TamanoDiscoDuroSeeder extends Seeder
{
    public function run(): void
    {
        $tamano = [
            ['3.5','Descripcion'],
            ['2.5','Descripcion']
        ];

        $tamano = array_map(function ($tamano) {
            return [
                'tamano_nombre' => $tamano[0],
                'tamano_descripcion' => $tamano[1],
            ];
        }, $tamano);

        Tamano::insert($tamano);
    }
}
