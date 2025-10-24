<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoEntrada;

class TipoEntradaSeeder extends Seeder
{
    public function run(): void
    {
        //Tipos de USB: https://hilelectronic.com/es/right-usb-type/
        $entradas = [
            'Desconocida',
            'No existe',
            'USB-A',//la entrada más común            
            'USB-C',//entrada más moderna
            'USB-B',//entrada más común en impresoras
            'USB-Mini',//entrada más común en cámaras
            'USB-Micro',//entrada más común en móviles
            'USB-Micro-B',//entrada de algunos HDD 2.5
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
