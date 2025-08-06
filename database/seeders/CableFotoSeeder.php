<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CableFotoSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener todos los cables existentes
        $cables = DB::table('cable')->get();
        
        // Preparar datos para inserción
        $fotos = [];
        $now = Carbon::now();
        
        foreach ($cables as $cable) 
        {
            // Verificar si el cable tiene foto definida
            if (!empty($cable->cable_foto)) 
            {
                $ruta = $cable->cable_foto;
                
                // Si es una imagen por defecto, mantenerla
                if (str_contains($ruta, 'desconocido.jpg')) 
                {
                    $fotos[] = [
                        'cable_id' => $cable->id,
                        'nombre_archivo' => 'desconocido.jpg',
                        'ruta' => $ruta,
                        'created_at' => $now,
                        'updated_at' => $now
                    ];
                } 
                // Si es una imagen específica, crear registro
                else {
                    $nombreArchivo = basename($ruta);
                    
                    $fotos[] = [
                        'cable_id' => $cable->id,
                        'nombre_archivo' => $nombreArchivo,
                        'ruta' => $ruta,
                        'created_at' => $now,
                        'updated_at' => $now
                    ];
                }
            }
        }
        
        // Insertar fotos en la base de datos
        DB::table('cable_fotos')->insert($fotos);
        
        $this->command->info('Fotos de cables insertadas: ' . count($fotos));
    }
}