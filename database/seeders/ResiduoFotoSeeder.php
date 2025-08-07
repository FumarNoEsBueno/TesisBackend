<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResiduoFoto;
use App\Models\Residuo;

class ResiduoFotoSeeder extends Seeder
{
    public function run(): void
    {
        $residuos = Residuo::pluck('id');

        foreach ($residuos as $residuo_id) {
            ResiduoFoto::create([
                'residuo_id' => $residuo_id,
                'nombre_archivo' => 'foto_residuo_' . $residuo_id . '.jpg',
                'ruta' => 'storage/residuos/foto_residuo_' . $residuo_id . '.jpg'
            ]);
        }
    }
}
