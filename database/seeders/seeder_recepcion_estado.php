<?php

namespace Database\Seeders;

use App\Models\recepcion_estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seeder_recepcion_estado extends Seeder
{
    public function run(): void
    {
        $estados = [
            'No recepcionado',
            'Recepcionado',
            'Recepcion cancelada'
        ];

        $estados = array_map(function ($estado) {
            return [
                'recepcion_estado_nombre' => $estado,
            ];
        }, $estados);

        recepcion_estado::insert($estados);
    }
}
