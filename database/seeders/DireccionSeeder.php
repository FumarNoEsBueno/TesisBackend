<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Direccion;

class DireccionSeeder extends Seeder
{
    public function run(): void
    {
        $direcciones = [
            ['Calle falsa 123',1,1],
            ['Caller real 321',2,1],
            ['Caller real 3212',2,2],
        ];

        $direcciones = array_map(function ($direccion) {
            return [
                'direccion_nombre' => $direccion[0],
                'ciudad_id' => $direccion[1],
                'user_id' => $direccion[2],
            ];
        }, $direcciones);

        Direccion::insert($direcciones);
    }
}
