<?php

namespace Database\Seeders;

use App\Models\model_descuento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seeder_descuento extends Seeder
{
    public function run(): void
    {
        $descuentos = [
            10,
            20,
            30,
            40,
            50,
            60,
            70,
            80,
            90
        ];

        $descuentos = array_map(function ($descuento) {
            return [
                'descuento_porcentaje' => $descuento,
            ];
        }, $descuentos);

        model_descuento::insert($descuentos);
    }
}
