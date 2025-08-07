<?php

// database/seeders/CargadorFotoSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CargadorFotoSeeder extends Seeder
{
    public function run()
    {
        $fotosPorModelo = [
            'SOY024A-1200200EU' => ['cargadores/1.jpg'],
            'HP-USB-C-65W-GEN'  => ['cargadores/hp1.jpg', 'cargadores/hp2.jpg'],
            'UNIV-9TIPS-90W'    => ['cargadores/univ1.jpg', 'cargadores/univ2.jpg'],
        ];

        foreach ($fotosPorModelo as $modelo => $paths) {
            $cargador = DB::table('cargador')->where('modelo', $modelo)->first();
            $cargadorId = $cargador?->id;

            if (!$cargadorId) {
                // si no existe, inserta foto por defecto luego
                continue;
            }

            $inserts = [];
            foreach ($paths as $ruta) {
                $inserts[] = [
                    'cargador_id' => $cargadorId,
                    'nombre_archivo' => basename($ruta),
                    'ruta' => $ruta,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Si no hay rutas, inserta el default.jpg
            if (empty($inserts)) {
                $inserts[] = [
                    'cargador_id' => $cargadorId,
                    'nombre_archivo' => 'default.jpg',
                    'ruta' => 'cargadores/default.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('cargador_fotos')->insert($inserts);
        }
    }
}
