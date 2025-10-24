<?php

namespace Database\Seeders;

use App\Models\MetodoDespacho;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetodoDespachoSeeder extends Seeder
{
    public function run(): void
    {
        $metodos = [
            ['Retiro en tienda','Entrega en tienda','retiro'],
            ['Despacho a domicilio','Retiro a domicilio','despacho']
        ];

        $metodos = array_map(function ($metodo) {
            return [
                'metodo_despacho_nombre' => $metodo[0],
                'metodo_recepcion_nombre' => $metodo[1],
                'metodo_despacho_slug' => $metodo[2],
            ];
        }, $metodos);

        MetodoDespacho::insert($metodos);
    }
}
