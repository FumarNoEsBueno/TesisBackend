<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seeder_tipo_periferico extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            'Teclado',
            'Microfono',
            'Audifonos',
            'Cable',
            'Mouse'
        ];

        $tipos = array_map(function ($tipo) {
            return [
                'nombre_tipo_periferico' => $tipo,
            ];
        }, $tipos);

        tipo_periferico::insert($tipos);
    }
}
