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
            [
                'nombre' => 'Martillo',
                'descripcion' => 'Mango de goma, comprado en la vega nonguen',
                'estado_id' => 1,
                'peso' => 0.35,
                'fecha' => '2025-06-11',
                'hora' => '09:00',
                'users_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Taladro',
                'descripcion' => 'Rojo, prestado por el papa Jean',
                'estado_id' => 1,
                'peso' => 2.5,
                'fecha' => '2025-06-10',
                'hora' => '19:00',
                'users_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Dremel de aliexpress',
                'descripcion' => 'Mala calidad, pero funciona',
                'estado_id' => 1,
                'peso' => 0.5,
                'fecha' => '2025-06-10',
                'hora' => '13:20',
                'users_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Osciloscopio',
                'descripcion' => 'Mala calidad, pero funciona',
                'estado_id' => 1,
                'peso' => 0.5,
                'fecha' => '2025-06-10',
                'hora' => '13:20',
                'users_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cautin',
                'descripcion' => 'Con ese se quemo el Diego',
                'estado_id' => 1,
                'peso' => 1.5,
                'fecha' => '2025-06-10',
                'hora' => '13:20',
                'users_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Multimetro',
                'descripcion' => 'Mide la corriente, voltaje y resistencia',
                'estado_id' => 1,
                'peso' => 0.5,
                'fecha' => '2025-06-10',
                'hora' => '13:20',
                'users_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
