<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\tamano;

class seeder_tamano_disco_duro extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tamanos = [
            ['3.5','Descripcion'],
            ['2.5','Descripcion']
        ];

        $tamanos = array_map(function ($tamano) {
            return [
                'tamano_nombre' => $tamano[0],
                'tamano_descripcion' => $tamano[1],
            ];
        }, $tamanos);

        tamano::insert($tamanos);
    }
}
