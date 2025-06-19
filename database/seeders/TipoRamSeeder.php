<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoRam;

class TipoRamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            'DDR1',
            'DDR2',
            'DDR3',
            'DDR4',
            'DDR5'
        ];

        $tipos = array_map(function ($tipo) {
            return [
                'tipo_ram_nombre' => $tipo,
            ];
        }, $tipos);

        TipoRam::insert($tipos);
    }
}
