<?php

namespace Database\Seeders;

use App\Models\Descuento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DescuentoSeeder extends Seeder
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

        Descuento::insert($descuentos);
    }
}
