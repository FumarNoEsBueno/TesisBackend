<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VelocidadRam;

class VelocidadRamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $velocidades = [
            '3200 Hz',
            '3666 Hz',
            '3800 Hz'
        ];

        $velocidades = array_map(function ($velocidad) {
            return [
                'velocidad_ram_velocidad' => $velocidad,
            ];
        }, $velocidades);

        VelocidadRam::insert($velocidades);
    }
}
