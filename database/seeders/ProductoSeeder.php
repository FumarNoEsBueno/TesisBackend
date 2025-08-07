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
                // Obtener almacen_id de la tabla específica
                $almacenId = DB::table($tipo)
                    ->where('id', $objetoId)
                    ->value('almacen_id');
                
                DB::table('producto')->updateOrInsert(
                    [
                        'tipo_objeto' => $tipo,
                        'id_objeto' => $objetoId
                    ],
                    [
                        'almacen_id' => $almacenId,
                        'created_at' => $now,
                        'updated_at' => $now
                    ]
                );
            }
        }
    }
}