<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CableSeeder extends Seeder
{
    public function run(): void
    {
        // Mapeos de estado y disponibilidad
        $estadoMap = ['Nuevo' => 1, 'Bueno' => 2, 'Usado' => 3, 'Dañado' => 4];
        $disponibilidadMap = ['Disponible' => 1, 'Reservado' => 2, 'Vendido' => 3];
        
        // Mapeo de tipos de entrada para diferentes cables
        $tipoEntradaMap = [
            'VGA a VGA'          => [1, 1],
            'HDMI a HDMI'         => [2, 2],
            'HDMI a VGA'          => [2, 1],
            'HDMI a DisplayPort'  => [2, 6],
            'USB-C a USB-C'       => [3, 3],
            'USB-A a USB-C'       => [4, 3],
            'Ethernet'            => [5, 5],
            'DisplayPort'         => [6, 6],
            'Lightning a USB-A'   => [7, 4],                        
            'USB-C a HDMI'        => [3, 2]
        ];

        $cables = [
            // nombre                 | disponibilidad   | estado   | largo | descripción                               | unitario | final | foto              | tipo_entrada
            ['Cable VGA 1m',           'Disponible',     'Usado',    1.0,   'VGA nuevo en empaque original',                0,        0,   'cables/VGA_VGA.png',          'VGA a VGA'       ],
            ['Cable HDMI 2.0',         'Disponible',     'Bueno',    2.0,   'HDMI de alta velocidad para 4K',               0,        0,   'cables/HDMI_HDMI.jpg',        'HDMI a HDMI'     ],
            ['Cable USB-C',            'Reservado',      'Usado',    1.0,   'USB-C para carga rápida de dispositivos',      0,        0,   'cables/USB-C_USB-C.png',      'USB-C a USB-C'   ],
            ['Cable Ethernet Cat5e',    'Disponible',     'Nuevo',    3.0,   'Cable de red Cat5e',                          0,        0,   'cables/ETHERNET_ETHERNET.jpg','Ethernet'        ],
            ['Cable USB-A a USB-C',    'Disponible',     'Bueno',    1.5,   'Cable para carga y transferencia de datos',    0,        0,   'cables/USB-A_USB-C.png',      'USB-A a USB-C'   ],                        
            ['Cable HDMI 5m',          'Disponible',     'Usado',    5.0,   'HDMI largo para instalaciones',                0,        0,   'cables/HDMI_HDMI.jpg',        'HDMI a HDMI'     ],
            ['Cable VGA 3m',           'Disponible',     'Dañado',   3.0,   'VGA con conector con los pines doblados',      0,        0,   'cables/VGA_VGA.png',          'VGA a VGA'       ],            
            ['Cable USB-C Largo',      'Disponible',     'Bueno',    2.0,   'USB-C de 2m para carga rápida',                0,        0,   'cables/USB-C_USB-C.png',   'USB-C a USB-C'      ],
            ['Cable VGA a HDMI',       'Disponible',     'Usado',    1.5,   'Adaptador inseparable',                        0,        0,   'cables/desconocido.jpg',    'VGA a HDMI'        ],
            ['Cable Ethernet Cat5e',   'Disponible',     'Bueno',    2.0,   'Cable de red Cat5e',                           0,        0,   'cables/ETHERNET_ETHERNET.jpg','Ethernet'        ],
            ['Cable USB-C a HDMI',     'Vendido',        'Nuevo',    1.0,   'Adaptador USB-C a HDMI 4K',                    0,        0,   'cables/desconocido.jpg',   'USB-C a HDMI'       ],
            ['Cable USB Extensión',   'Disponible',     'Bueno',    3.0,   'Extensión USB 3.0',                             0,        0,   'cables/USB-A_USB-C.png',     'USB-A a USB-C'    ],
            ['Cable HDMI Premium',    'Reservado',      'Nuevo',    1.5,   'HDMI de alta calidad con revestimiento de oro', 0,        0,   'cables/HDMI_HDMI.jpg',   'HDMI a HDMI'          ],
            ['Cable USB-C Trenzado',   'Disponible',     'Nuevo',    1.2,   'USB-C trenzado resistente',                    0,        0,   'cables/USB-C_USB-C.png',  'USB-C a USB-C'       ],            
        ];

        $data = [];
        $now = Carbon::now();

        foreach ($cables as $cable) {
            $tipoEntradaKey = $cable[8];
            $tipoEntradaIds = $tipoEntradaMap[$tipoEntradaKey] ?? [1, 1];
            
            $largo = $cable[3];
            $peso = $this->calculateWeight($cable[0], $largo);
            $descuento = ($cable[5] - $cable[6]) > 0 ? ($cable[5] - $cable[6]) : 0;
            
            $createdAt = $now->copy()->subDays(rand(0, 90));
            
            $data[] = [
                'cable_nombre'           => $cable[0],
                'disponibilidad_id'      => $disponibilidadMap[$cable[1]],
                'estado_id'              => $estadoMap[$cable[2]],
                'almacen_id'             => rand(1, 3),
                'marca_id'               => rand(1, 5),
                'tipo_entrada_1_id'      => $tipoEntradaIds[0],
                'tipo_entrada_2_id'      => $tipoEntradaIds[1],
                'comentario'             => $cable[4],
                'test'                   => $cable[2] !== 'Dañado' ? true : (rand(0, 1) == 1),
                'largo'                  => $largo,
                'peso'                   => $peso,
                'descripcion'            => $cable[4],
                'cable_precio_unitario'  => $cable[5],
                'cable_precio_final'     => $cable[6],
                'cable_foto'             => $cable[7],
                'cable_descuento'        => min(255, $descuento),
                'cable_destacado'        => rand(0, 0),//cable destacado numero random entero entre 0 y 0
                'solicitud_recepcion_id' => null,
                'created_at'             => $createdAt,
                'updated_at'             => $createdAt->copy()->addDays(rand(1, 30))
            ];
        }

        DB::table('cable')->insert($data);
    }
    
    private function calculateWeight($nombre, $largo)
    {
        $pesoBase = 0.1;
        
        if (str_contains($nombre, 'VGA')) {
            return round(0.25 * $largo, 2);
        }
        if (str_contains($nombre, 'HDMI') || str_contains($nombre, 'DisplayPort')) {
            return round(0.15 * $largo, 2);
        }
        if (str_contains($nombre, 'Ethernet')) {
            return round(0.20 * $largo, 2);
        }
        if (str_contains($nombre, 'USB')) {
            return round(0.12 * $largo, 2);
        }
        
        return round($pesoBase * $largo, 2);
    }
}