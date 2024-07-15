<?php

namespace Database\Seeders;

use App\Models\model_metodo_despacho;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seeder_metodo_despacho extends Seeder
{
    public function run(): void
    {
        $metodos = [
            ['En tienda','retiro'],
            ['A domicilio','despacho']
        ];

        $metodos = array_map(function ($metodo) {
            return [
                'metodo_despacho_nombre' => $metodo[0],
                'metodo_despacho_slug' => $metodo[1],
            ];
        }, $metodos);

        model_metodo_despacho::insert($metodos);
    }
}
