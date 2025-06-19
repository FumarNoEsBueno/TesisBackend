<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CableSeeder extends Seeder
{
    public function run(): void
    {
        // Mapeos de estados y disponibilidad
        $estadoMap = ['Sin abrir' => 1, 'Bueno' => 2];
        $disponibilidadMap = ['Si' => 1, 'NO' => 2];
        
        // Mapeo de tipos de entrada para diferentes cables
        $tipoEntradaMap = [
            'VGA' => [1, 2],    // VGA a VGA
            'Epson a USB' => [3, 4] // USB a otro conector
        ];

        $rows = [
            // nombre         | disponibilidad | estado     | largo | descripcion                         | unitario | final | foto          | tipo_entrada
            ['Cable VGA',     'Si',             'Sin abrir', 1.00,   'VGA nuevo empacado y sellado',      4500,     4000,  'vga.jpg',     'VGA'],
            ['Cable VGA',     'Si',             'Sin abrir', 1.00,   'VGA nuevo empacado y sellado',      4500,     4000,  'vga.jpg',     'VGA'],
            ['Cable VGA',     'Si',             'Sin abrir', 1.00,   'VGA nuevo empacado y sellado',      4500,     4000,  'vga.jpg',     'VGA'],
            ['Cable VGA',     'Si',             'Sin abrir', 1.00,   'VGA nuevo empacado y sellado',      4500,     4000,  'vga.jpg',     'VGA'],
            ['Cable VGA',     'NO',             'Sin abrir', 1.00,   'VGA nuevo empacado y sellado',      4500,     4000,  'vga.jpg',     'VGA'],
            ['Cable VGA',     'NO',             'Bueno',     1.75,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg',     'VGA'],
            ['Cable VGA',     'Si',             'Bueno',     1.45,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg',     'VGA'],
            ['Cable VGA',     'Si',             'Bueno',     1.80,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg',     'VGA'],
            ['Cable VGA',     'Si',             'Bueno',     1.40,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg',     'VGA'],
            ['Cable VGA',     'Si',             'Bueno',     1.40,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg',     'VGA'],
            ['Cable VGA',     'Si',             'Bueno',     1.50,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg',     'VGA'],
            ['Cable VGA',     'Si',             'Bueno',     1.45,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg',     'VGA'],
            ['Cable VGA',     'Si',             'Bueno',     1.80,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg',     'VGA'],
            ['Cable VGA',     'Si',             'Bueno',     1.80,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg',     'VGA'],
            ['Epson a USB',   'Si',             'Sin abrir', null,   'Cable epson a USB nuevo',           3000,     2500,  'epson_usb.jpg', 'Epson a USB'],
        ];

        $data = array_map(function($r) use ($estadoMap, $disponibilidadMap, $tipoEntradaMap) {
            $tipoEntradaKey = $r[8] ?? 'VGA';
            $tipoEntradaIds = $tipoEntradaMap[$tipoEntradaKey] ?? [1, 2];
            
            return [
                'cable_nombre'            => $r[0],
                'almacen_id'              => 1,  // Almacén por defecto
                'disponibilidad_id'       => $disponibilidadMap[$r[1]] ?? 1,
                'estado_id'               => $estadoMap[$r[2]] ?? 1,
                'test'                    => $r[3] ?? null,  // Decimal o null
                'largo'                   => $r[3] ?? null,  // Usa el mismo valor que largo
                'comentario'              => "Estado: {$r[2]}. {$r[4]}", // Comentario más descriptivo
                'descripcion'             => $r[4],
                'cable_precio_unitario'   => $r[5],
                'cable_precio_final'      => $r[6],
                'cable_foto'              => $r[7],
                'cable_descuento'         => 0,  // Descuento por defecto 0
                'cable_destacado'         => 0,  // 0 = no destacado, 1 = destacado
                'marca_id'                => 1,  // Marca por defecto
                'solicitud_recepcion_id'  => null,
                'tipo_entrada_id'         => $tipoEntradaIds[0],
                'tipo_entrada_1_id'       => $tipoEntradaIds[0],
                'tipo_entrada_2_id'       => $tipoEntradaIds[1]
            ];
        }, $rows);

        DB::table('cable')->insert($data);
    }
}