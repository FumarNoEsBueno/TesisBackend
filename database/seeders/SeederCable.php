<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederCable extends Seeder
{
    public function run(): void
    {
        // Estado textual a ID
        $estadoMap = [
            'Sin abrir' => 1,
            'Bueno' => 2,
        ];

        $rows = [
            // nombre         | disponibilidad | estado     | largo | descripcion                         | unitario | final | foto
            ['Cable VGA',     'Si',             'Sin abrir', 1.00,   'VGA nuevo empacado y sellado',      4500,     4000,  'vga.jpg'],
            ['Cable VGA',     'Si',             'Sin abrir', 1.00,   'VGA nuevo empacado y sellado',      4500,     4000,  'vga.jpg'],
            ['Cable VGA',     'Si',             'Sin abrir', 1.00,   'VGA nuevo empacado y sellado',      4500,     4000,  'vga.jpg'],
            ['Cable VGA',     'Si',             'Sin abrir', 1.00,   'VGA nuevo empacado y sellado',      4500,     4000,  'vga.jpg'],
            ['Cable VGA',     'NO',             'Sin abrir', 1.00,   'VGA nuevo empacado y sellado',      4500,     4000,  'vga.jpg'],
            ['Cable VGA',     'NO',             'Bueno',     1.75,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg'],
            ['Cable VGA',     'Si',             'Bueno',     1.45,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg'],
            ['Cable VGA',     'Si',             'Bueno',     1.80,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg'],
            ['Cable VGA',     'Si',             'Bueno',     1.40,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg'],
            ['Cable VGA',     'Si',             'Bueno',     1.40,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg'],
            ['Cable VGA',     'Si',             'Bueno',     1.50,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg'],
            ['Cable VGA',     'Si',             'Bueno',     1.45,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg'],
            ['Cable VGA',     'Si',             'Bueno',     1.80,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg'],
            ['Cable VGA',     'Si',             'Bueno',     1.80,   'VGA usado en buenas condiciones',   4500,     4000,  'vga.jpg'],
            ['Epson a USB',   'Si',             'Sin abrir', null,   'Cable epson a USB nuevo',           3000,     2500,  'epson_usb.jpg'],
        ];

        $data = array_map(function($r) use ($estadoMap) {
            return [
                'cable_nombre'            => $r[0],
                'almacen_id'              => 1,
                'disponibilidad_id'       => $r[1] === 'Si' ? 1 : 2,
                'estado_id'               => $estadoMap[$r[2]] ?? 1,
                'test'                    => (string)($r[3] ?? ''),
                'largo'                   => $r[3] !== null ? floatval($r[3]) : null,
                'comentario'              => $r[2],
                'descripcion'             => $r[4],
                'cable_precio_unitario'   => $r[5],
                'cable_precio_final'      => $r[6],
                'cable_foto'              => $r[7],
                'cable_descuento'         => null,
                'cable_destacado'         => false,
                'marca_id'                => 1,
                'solicitud_recepcion_id'  => null,
                'tipo_entrada_id'         => 1,
            ];
        }, $rows);

        DB::table('cable')->insert($data);
    }
}
