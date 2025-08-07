<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Celular;

class CelularSeeder extends Seeder
{
    public function run(): void
    {
        $celulares = [
            [
                'marca'             => 'Apple',
                'modelo'            => 'A1287',
                'nombre_modelo'     => 'iPhone Model A1287',
                'memoria_interna'   => '16 GB',
                'estado'            => 'Bueno',
                'condicion_pantalla'=> 'Buena',
                'almacen_id'        => 1,
                'comentarios'       => 'Funciona bien, verificar batería',
                'numero_modelo'     => 'A1287',
                'imei_1'            => '356789102345678',
            ],
            [
                'marca'             => 'Samsung',
                'modelo'            => null,
                'nombre_modelo'     => 'Samsung Rojo',
                'memoria_interna'   => '32 GB',
                'estado'            => 'Diagnóstico',
                'condicion_pantalla'=> 'Buena',
                'almacen_id'        => 1,
                'comentarios'       => 'Pertenece a profe de la UBB. Hay que recuperar datos.',
            ],
            [
                'marca'             => 'Samsung',
                'modelo'            => null,
                'nombre_modelo'     => 'Samsung Negro',
                'memoria_interna'   => '64 GB',
                'estado'            => 'Formatear',
                'condicion_pantalla'=> 'Clizada',
                'almacen_id'        => 1,
                'comentarios'       => 'Necesita un formateo completo.',
            ],
        ];

        foreach ($celulares as $c) {
            // 1) Insert en tabla celular
            $celularId = DB::table('celular')->insertGetId([
                'marca'              => $c['marca'],         
                'modelo'             => $c['modelo'],
                'nombre_modelo'      => $c['nombre_modelo'],
                'memoria_interna'    => $c['memoria_interna'],
                'estado'             => $c['estado'],
                'condicion_pantalla' => $c['condicion_pantalla'],
                'almacen_id'         => $c['almacen_id'],
                'comentarios'        => $c['comentarios'],
                'numero_modelo'      => $c['numero_modelo'] ?? null,
                'imei_1'             => $c['imei_1'] ?? null,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);

            // 2) Insert en tabla producto
            $productoId = DB::table('producto')->insertGetId([
                'tipo_objeto' => 'celular',
                'id_objeto'   => $celularId,
                'fecha'       => now()->toDateString(),
                'hora'        => now()->toTimeString(),
                'descripcion' => $c['nombre_modelo'] ?? '',
                'peso'        => 0.0, // o asigna un valor si lo tienes
                'user_id'     => 1,
                'estado_id'   => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            // 3) Opcional: guarda la relación en celular si existe columna producto_id
            if (Schema::hasColumn('celular', 'producto_id')) {
                DB::table('celular')
                  ->where('id', $celularId)
                  ->update(['producto_id' => $productoId]);
            }
        }
    }
}
