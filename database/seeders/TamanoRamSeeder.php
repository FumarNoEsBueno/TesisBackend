<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TamanoRam;

class TamanoRamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tamano = [
            'PC',
            'Notebook'
        ];

        $tamano = array_map(function ($tamano) {
            return [
                'tamano_ram_nombre' => $tamano,
            ];
        }, $tamano);

        TamanoRam::insert($tamano);
    }
}
