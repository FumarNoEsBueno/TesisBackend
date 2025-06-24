<?php

namespace Database\Seeders;

use App\Models\RecepcionEstado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecepcionEstadoSeeder extends Seeder
{
    public function run(): void
    {
        $estado = [
            'No recepcionado',
            'Recepcionado',
            'Recepcion cancelada'
        ];

        $estado = array_map(function ($estado) {
            return [
                'recepcion_estado_nombre' => $estado,
            ];
        }, $estado);

        RecepcionEstado::insert($estado);
    }
}
