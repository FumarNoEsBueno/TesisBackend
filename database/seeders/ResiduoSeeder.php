<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResiduoSeeder extends Seeder
{
    public function run(): void
    {
        $datos = [
            // almacen Nonguen 1, almacen Hualpen 2, Casa del Naufrago 3
            // almacen Nonguen (almacen_id = 1)
            [
                'nombre'       => 'Computadores viejos',
                'fecha'        => '2025-05-31',
                'hora'         => '14:30:00',
                'descripcion'  => '5 computadores de escritorio sin uso en el rincón del almacén',
                'peso'         => 50.0,
                'almacen_id'   => 1,
                'user_id'     => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nombre'       => 'Celulares usados',
                'fecha'        => '2025-05-30',
                'hora'         => '10:15:00',
                'descripcion'  => '3 celulares en la torre del escritorio de Nonguen',
                'peso'         => 1.50,
                'almacen_id'   => 1,
                'user_id'     => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nombre'       => 'Monton de pantallas',
                'fecha'        => '2025-05-29',
                'hora'         => '11:20:00',
                'descripcion'  => '6 pantallas apiladas en colgador del segundo piso de Nonguen',
                'peso'         => 18.0,
                'almacen_id'   => 1,
                'user_id'     => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nombre'       => 'Barril de teclados viejos',
                'fecha'        => '2025-05-28',
                'hora'         => '09:50:00',
                'descripcion'  => '10 teclados sin testear, algunos sin cable, otros sin teclas en barril de cartón',
                'peso'         => 5.5,
                'almacen_id'   => 1,
                'user_id'     => 3,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            // almacen Hualpen (almacen_id = 2)
            [
                'nombre'       => 'item_de_ejemplo',
                'fecha'        => '2025-05-30',
                'hora'         => '13:00:00',
                'descripcion'  => '20 metros de ejemplo envuelto en plástico',
                'peso'         => 4.20,
                'almacen_id'   => 2,
                'user_id'     => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nombre'       => 'Discos duros de ejemplo',
                'fecha'        => '2025-05-29',
                'hora'         => '16:40:00',
                'descripcion'  => '3 cajas con 4 discos duros imaginarios cada una en estantería central',
                'peso'         => 12.0,
                'almacen_id'   => 2,
                'user_id'     => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            
            [
                'nombre'       => 'Notebooks antiguos de ejemplo',
                'fecha'        => '2025-05-27',
                'hora'         => '14:00:00',
                'descripcion'  => '5 notebooks antiguos en estantería lateral, algunos con pantallas rotas',
                'peso'         => 1.8,
                'almacen_id'   => 2,
                'user_id'     => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],

            // Casa Naufrago (almacen_id = 3)
            [
                'nombre'       => 'Rollos de cable',
                'fecha'        => '2025-05-28',
                'hora'         => '09:00:00',
                'descripcion'  => '10 rollos de cable de red guardados en palé al fondo',
                'peso'         => 25.5,
                'almacen_id'   => 3,
                'user_id'     => 3,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nombre'       => 'Impresoras desechadas',
                'fecha'        => '2025-05-26',
                'hora'         => '12:30:00',
                'descripcion'  => '2 impresoras láser en zona de reciclaje',
                'peso'         => 18.0,
                'almacen_id'   => 3,
                'user_id'     => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],

            // Mezcla de ubicaciones
            [
                'nombre'       => 'Baterías usadas',
                'fecha'        => '2025-05-25',
                'hora'         => '08:15:00',
                'descripcion'  => '20 baterías AA en cajas plásticas sobre estantería',
                'peso'         => 2.0,
                'almacen_id'   => 2,
                'user_id'     => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nombre'       => 'Fuentes de poder',
                'fecha'        => '2025-05-24',
                'hora'         => '15:45:00',
                'descripcion'  => '5 fuentes de poder de PC en contenedor metálico',
                'peso'         => 14.5,
                'almacen_id'   => 1,
                'user_id'     => 3,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nombre'       => 'Routers viejos',
                'fecha'        => '2025-05-23',
                'hora'         => '17:10:00',
                'descripcion'  => '7 routers Wi-Fi con antenas sueltas en saco gris',
                'peso'         => 4.2,
                'almacen_id'   => 3,
                'user_id'     => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ];

        DB::table('residuo')->insert($datos);
    }
}
