<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoEntrada;

class TipoEntradaSeeder extends Seeder
{
    public function run(): void
    {
        $entradas = [
            'USB-B',
            'USB-C',
            'VGA',
            'HDMI',
            'DP',
            'SATA-3',
            'PS2'
        ];

        $entradas = array_map(function ($entrada) {
            return [
                'tipo_entrada_nombre' => $entrada,
            ];
        }, $entradas);

        TipoEntrada::insert($entradas);
    }
}
