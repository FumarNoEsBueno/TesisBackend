<?php

namespace Database\Seeders;

use App\Models\MetodoPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetodoPagoSeeder extends Seeder
{
    public function run(): void
    {
        $metodos = [
            ['Transferencia','transferencia'],
            ['Pago en tienda','enTienda'],
            ['WebPay','webpay']
        ];

        $metodos = array_map(function ($metodo) {
            return [
                'metodo_pago_nombre' => $metodo[0],
                'metodo_pago_slug' => $metodo[1],
            ];
        }, $metodos);

        MetodoPago::insert($metodos);
    }
}
