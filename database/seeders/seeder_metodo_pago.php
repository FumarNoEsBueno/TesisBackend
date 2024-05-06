<?php

namespace Database\Seeders;

use App\Models\model_metodo_pago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seeder_metodo_pago extends Seeder
{
    public function run(): void
    {
        $metodos = [
            'Transferencia',
            'Pago en tienda',
            'WebPay'
        ];

        $metodos = array_map(function ($metodo) {
            return [
                'metodo_pago_nombre' => $metodo[0],
            ];
        }, $metodos);

        model_metodo_pago::insert($metodos);
    }
}
