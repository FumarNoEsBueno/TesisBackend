<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $tipos = ['cable', 'celular', 'cargador', 'ram', 'disco_duro']; // Agrega todos los tipos
        
        foreach ($tipos as $tipo) {
            // Obtener IDs de objetos específicos
            $objetos = DB::table($tipo)->pluck('id');
            
            foreach ($objetos as $objetoId) {            
                $almacenId = DB::table($tipo)
                    ->where('id', $objetoId)
                    ->value('almacen_id');
                
                DB::table('producto')->updateOrInsert(
                    ['tipo_objeto' => 'celular', 'id_objeto' => 1],
                    [
                        'fecha' => now(), // ← Esto es lo que faltaba
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}