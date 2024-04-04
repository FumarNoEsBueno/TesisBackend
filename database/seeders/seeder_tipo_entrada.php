<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seeder_tipo_entrada extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $entradas = [
            'USB-B',
            'USB-C',
            'VGA',
            'HDMI',
            'DP',
            'PS2'
        ];

        $entradas = array_map(function ($entrada) {
            return [
                'tipo_entrada_nombre' => $entrada,
            ];
        }, $entradas);

        tipo_entrada::insert($entradas);
    }
}
