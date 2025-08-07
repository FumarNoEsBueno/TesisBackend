<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CargadorSeeder extends Seeder
{
    public function run()
    {
        $cargadores = [
        [
            'modelo'            => 'SOY024A-1200200EU',
            'marca'             => '404',
            'input'             => '100-240V-50/60Hz',
            'output'            => '12V=2.0A',
            'amp'               => '0,6A max',
            'diametro_od_id'    => '5,5mm/2,5mm',
            'largo_punta'       => '2cm',
            'disponibilidad'    => true,
            'test'              => null,
            'largo_m'           => 1.0,
            'descripcion_punta' => 'punta negra con anillo de metal interno hundido',
            'precio_unitario'   => null,
            'precio_volumen'    => null,
        ],
        // … existentes …

        // Nuevo: Cargador genérico HP
        [
            'modelo'            => 'HP-USB-C-65W-GEN',
            'marca'             => 'HP',
            'input'             => '100-240V-50/60Hz',
            'output'            => '5V-20V=3.25A(max)',
            'amp'               => '3.25A max',
            'diametro_od_id'    => 'USB-C',
            'largo_punta'       => 'Cable integrado 1.8m',
            'disponibilidad'    => true,
            'test'              => null,
            'largo_m'           => 1.8,
            'descripcion_punta' => 'Cargador HP USB-C 65W genérico',
            'precio_unitario'   => null,
            'precio_volumen'    => null,
        ],

        // Nuevo: Cargador universal con 9 puntas
        [
            'modelo'            => 'UNIV-9TIPS-90W',
            'marca'             => 'Universal Pro',
            'input'             => '100-240V-50/60Hz',
            'output'            => '5V-20V@4.5A(max)',
            'amp'               => '4.5A max',
            'diametro_od_id'    => '9 puntas interchangeables',
            'largo_punta'       => 'Varios adaptadores incluidos',
            'disponibilidad'    => true,
            'test'              => null,
            'largo_m'           => 1.5,
            'descripcion_punta' => 'Cargador universal 90W con 9 puntas intercambiables',
            'precio_unitario'   => null,
            'precio_volumen'    => null,
        ],
    ];

        foreach ($cargadores as $c) {
            // 1) Insert en tabla cargador
            $cargadorId = DB::table('cargador')->insertGetId([
                'almacen_id'       => 1,         
                'modelo'           => $c['modelo'],
                'marca'            => $c['marca'],
                'input'            => $c['input'],
                'output'           => $c['output'],
                'amp'              => $c['amp'],
                'diametro_od_id'   => $c['diametro_od_id'],
                'largo_punta'      => $c['largo_punta'],
                'disponibilidad'   => $c['disponibilidad'],
                'test'             => $c['test'],
                'largo_m'          => $c['largo_m'],
                'descripcion_punta'=> $c['descripcion_punta'],
                'precio_unitario'  => $c['precio_unitario'],
                'precio_volumen'   => $c['precio_volumen'],
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);


            // 2) Insert en producto
            $productoId = DB::table('producto')->insertGetId([
                'tipo_objeto' => 'cargador',
                'id_objeto'   => $cargadorId,
                'fecha'       => now()->toDateString(),
                'hora'        => now()->toTimeString(),
                'descripcion' => $c['descripcion_punta'] ?? '',
                'peso'        => $c['largo_m'] ?? 0.0,
                'user_id'     => 1,
                'estado_id'   => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            // 3) Opcional: guarda la relación en cargador
            if (Schema::hasColumn('cargador', 'producto_id')) {
                DB::table('cargador')
                    ->where('id', $cargadorId)
                    ->update(['producto_id' => $productoId]);
            }
        }
    }
}
