<?php

namespace Database\Seeders;

use App\Models\EstadoCompra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoCompraSeeder extends Seeder
{
    public function run(): void
    {
        $estado = [
            ['Esperando pago','esperando'],
            ['Preparando pedido','preparando'],
            ['Listo para retirar','listo'],
            ['En transporte','transporte'],
            ['Entregado','entregado'],
            ['Retirado','retirado'],
            ['Cancelado','cancelado']
        ];

        $estado = array_map(function ($estado) {
            return [
                'estado_compra_nombre' => $estado[0],
                'estado_compra_slug' => $estado[1],
            ];
        }, $estado);

        EstadoCompra::insert($estado);
    }
}
