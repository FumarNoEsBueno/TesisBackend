<?php

namespace Database\Seeders;

use App\Models\capacidad_ram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seeder_capacidad_ram extends Seeder
{
    public function run(): void
    {
        $capacidades = [
            1,
            2,
            4,
            8,
            16,
            32
        ];

        $capacidades = array_map(function ($capacidad) {
            return [
                'capacidad_ram_capacidad' => $capacidad,
            ];
        }, $capacidades);

        capacidad_ram::insert($capacidades);
    }
}
