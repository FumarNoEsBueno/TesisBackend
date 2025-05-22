<?php

namespace Database\Seeders;

use App\Models\model_estado_compra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seeder_estado_compra extends Seeder
{
    public function run(): void
    {
        $estados = [
            ['Esperando pago','esperando'],
            ['Preparando pedido','preparando'],
            ['Listo para retirar','listo'],
            ['En transporte','transporte'],
            ['Entregado','entregado'],
            ['Retirado','retirado'],
            ['Cancelado','cancelado']
        ];

        $estados = array_map(function ($estado) {
            return [
                'estado_compra_nombre' => $estado[0],
                'estado_compra_slug' => $estado[1],
            ];
        }, $estados);

        model_estado_compra::insert($estados);
    }
}
