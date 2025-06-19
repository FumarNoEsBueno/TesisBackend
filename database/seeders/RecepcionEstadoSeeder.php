<?php

namespace Database\Seeders;

use App\Models\RecepcionEstado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecepcionEstadoSeeder extends Seeder
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

        RecepcionEstado::insert($estados);
    }
}
