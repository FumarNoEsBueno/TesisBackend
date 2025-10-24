<?php

namespace Database\Seeders;

use App\Models\CapacidadRam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CapacidadRamSeeder extends Seeder
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
                'CapacidadRam_capacidad' => $capacidad,
            ];
        }, $capacidades);

        CapacidadRam::insert($capacidades);
    }
}
