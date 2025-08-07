<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Celular;
use App\Models\CelularFoto;

class CelularFotoSeeder extends Seeder
{
    public function run(): void
    {
        $fotos = [
            'iPhone Model A1287' => [
                'celulares/iphone_a1287_1.jpg',
                'celulares/iphone_a1287_2.jpg',
            ],
            'Samsung Rojo' => [
                'celulares/samsung_rojo_1.jpg',
                'celulares/samsung_rojo_2.jpg',
            ],
            'Samsung Negro' => [
                'celulares/samsung_negro_1.jpg',
                'celulares/samsung_negro_2.jpg',
            ],
        ];

        foreach ($fotos as $nombreModelo => $rutas) {
            $celular = Celular::where('nombre_modelo', $nombreModelo)->first();

            if ($celular) {
                foreach ($rutas as $ruta) {
                    CelularFoto::create([
                        'celular_id' => $celular->id,
                        'ruta' => $ruta,
                    ]);
                }
            } else {
                $this->command->warn("No se encontró celular con nombre_modelo: $nombreModelo");
            }
        }
    }
}
