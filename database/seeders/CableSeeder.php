<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CableSeeder extends Seeder
{
    public function run(): void
    {
        // Mapeos de estado y disponibilidad
        $estadoMap = ['Sin abrir' => 1, 'Bueno' => 2];
        $disponibilidadMap = ['Si' => 1, 'NO' => 2];
        
        // Mapeo de tipos de entrada para diferentes cables
        $tipoEntradaMap = [
            'VGA'          => [1, 2],   // VGA a VGA
            'Epson a USB'  => [3, 4],   // Epson a USB
        ];

        $rows = [
            // nombre         | disponibilidad | estado     | largo | descripcion                         | unitario | final | foto             | tipo_entrada
            ['Cable VGA',     'Si',            'Sin abrir', 1.00, 'VGA nuevo empacado y sellado',       4500, 4000, 'vga.jpg',        'VGA'],
            ['Cable VGA',     'Si',            'Sin abrir', 1.75, 'VGA usado en buenas condiciones',    4500, 4000, 'vga.jpg',        'VGA'],
            ['Cable VGA',     'NO',            'Bueno',     1.45, 'VGA usado en buenas condiciones',    4500, 4000, 'vga.jpg',        'VGA'],
            ['Cable VGA',     'Si',            'Bueno',     1.80, 'VGA usado en buenas condiciones',    4500, 4000, 'vga.jpg',        'VGA'],
            ['Epson a USB',   'Si',            'Sin abrir', 1.20, 'Cable epson a USB nuevo',            3000, 2500, 'epson_usb.jpg',  'Epson a USB'],
        ];

        $data = array_map(function($r) use ($estadoMap, $disponibilidadMap, $tipoEntradaMap) {
            // Extraer los dos tipos de entrada
            $tipoEntradaKey = $r[8];
            $tipoEntradaIds = $tipoEntradaMap[$tipoEntradaKey] ?? [1, 2];

            // Generar un peso aproximado: 0.2 kg por metro
            $largo = $r[3];
            $peso = is_numeric($largo) ? round($largo * 0.2, 2) : null;

            return [
                'cable_nombre'           => $r[0],
                'disponibilidad_id'      => $disponibilidadMap[$r[1]] ?? 1,
                'estado_id'              => $estadoMap[$r[2]] ?? 1,
                'almacen_id'             => 1,  // Ajusta si tienes varios almacenes
                'marca_id'               => 1,  // Marca por defecto
                'tipo_entrada_1_id'      => $tipoEntradaIds[0],
                'tipo_entrada_2_id'      => $tipoEntradaIds[1],
                'comentario'             => "Estado: {$r[2]}. {$r[4]}",
                'test'                   => true,
                'largo'                  => $largo,
                'peso'                   => $r[3] ?? 0,
                'descripcion'            => $r[4],
                'cable_precio_unitario'  => $r[5],
                'cable_precio_final'     => $r[6],
                'cable_foto'             => $r[7],
                'cable_descuento'        => 0,
                'cable_destacado'        => 0,
                'solicitud_recepcion_id' => null,
                'created_at'             => now(),
                'updated_at'             => now(),
            ];
        }, $rows);

        DB::table('cable')->insert($data);
    }
}
