<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\marca;

class seeder_marca extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marcas = [
            'Toyota',
            'Apple',
            'Samsung',
            'Hyundai',
            'Acer',
            'Kingston',
            'Asus'
        ];

        $marcas = array_map(function ($marca) {
            return [
                'marca_nombre' => $marca,
            ];
        }, $marcas);

        marca::insert($marcas);
    }
}
