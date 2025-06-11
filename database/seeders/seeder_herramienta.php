<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\herramienta;

class seeder_herramienta extends Seeder
{
    public function run(): void
    {
        herramienta::insert([
            [
                'nombre' => 'Destornillador',
                'descripcion' => 'Philips, mango de goma',
                'estado_id' => 1,
                'peso' => 0.15,
                'fecha' => '2025-06-01',
                'hora' => '09:00',
                'users_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
