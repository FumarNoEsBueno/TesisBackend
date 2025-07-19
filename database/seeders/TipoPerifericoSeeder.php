<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoPeriferico;

class TipoPerifericoSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            'Teclado',
            'Microfono',
            'Audifonos',
            'Mouse'
        ];

        $tipos = array_map(function ($tipo) {
            return [
                'nombre_tipo_periferico' => $tipo,
            ];
        }, $tipos);

        TipoPeriferico::insert($tipos);
    }
}
