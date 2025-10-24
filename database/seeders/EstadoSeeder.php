<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    public function run(): void
    {
        $estado = [//almacena los estado de los productos
            ['Usado','usado'],
            ['Nuevo','nuevo'],
            

            ['Desmontar','desmontar'],            
            ['Destruir','destruir'],
            ['Destruido','destruido'],

            ['Revisar','revisar'],
            ['Revisado','revisado'],

            ['Perdido','perdido'],
            ['Robado','robado'],

            ['Reparar','reparar'],
            ['Reparado','reparado'],

            ['Upgradear','upgradear'],
            ['Upgradeado','upgradeado'],

            ['Pedido','pedido'],                        

            ['Donar','donar'],
            ['Donado','donado'],            
            
            ['En cuarentena','cuarentena'],
            ['Obsoleto','obsoleto'],
            ['Descontinuado','descontinuado'],
            ['En espera de entrega','espera_entrega'],
            ['En espera de pago','espera_pago'],
            ['En espera de aprobación','espera_aprobacion'],
            
            ['En espera de inspección','espera_inspeccion'],
            ['En espera de reparación','espera_reparacion'],
            ['En espera de actualización','espera_actualizacion'],
            ['En espera de confirmación','espera_confirmacion'],
            ['En espera de autorización','espera_autorizacion'],
            ['En espera de revisión técnica','espera_revision_tecnica'],
        ];

        $estado = array_map(function ($estado) {
            return [
                'estado_nombre' => $estado[0],
                'estado_descripcion' => $estado[1],
            ];
        }, $estado);

        Estado::insert($estado);
    }
}
