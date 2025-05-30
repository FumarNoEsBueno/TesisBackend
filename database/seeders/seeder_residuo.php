<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seeder_residuo extends Seeder
{
    public function run(): void
    {
        $datos = [
            // Casa del Diego (almacen_id = 2)
            [
                'nombre'       => 'Celulares usados',
                'fecha'        => '2025-05-30',
                'hora'         => '10:15:00',
                'descripcion'  => '5 celulares en las cajas bajo la escalera',
                'peso'         => 2.75,
                'almacen_id'   => 2,
                'users_id'     => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nombre'       => 'Monitores rotos',
                'fecha'        => '2025-05-29',
                'hora'         => '11:20:00',
                'descripcion'  => '2 monitores con pantallas agrietadas apilados en el rincón',
                'peso'         => 8.0,
                'almacen_id'   => 2,
                'users_id'     => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],

            // Casa del Jean (almacen_id = 1)
            [
                'nombre'       => 'Discos duros',
                'fecha'        => '2025-05-29',
                'hora'         => '16:40:00',
                'descripcion'  => '3 cajas con 4 discos duros cada una en estantería central',
                'peso'         => 12.0,
                'almacen_id'   => 1,
                'users_id'     => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nombre'       => 'Teclados viejos',
                'fecha'        => '2025-05-28',
                'hora'         => '09:50:00',
                'descripcion'  => '10 teclados mecánicos sin teclas en caja de cartón',
                'peso'         => 5.5,
                'almacen_id'   => 1,
                'users_id'     => 3,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nombre'       => 'Placas madre dañadas',
                'fecha'        => '2025-05-27',
                'hora'         => '14:00:00',
                'descripcion'  => '5 placas madre guardadas en estuche antiestático',
                'peso'         => 1.8,
                'almacen_id'   => 1,
                'users_id'     => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],

            // Bodega Central (almacen_id = 3)
            [
                'nombre'       => 'Rollos de cable',
                'fecha'        => '2025-05-28',
                'hora'         => '09:00:00',
                'descripcion'  => '10 rollos de cable de red guardados en palé al fondo',
                'peso'         => 25.5,
                'almacen_id'   => 3,
                'users_id'     => 3,
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
                'users_id'     => 2,
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
                'users_id'     => 1,
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
                'users_id'     => 3,
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
                'users_id'     => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ];

        DB::table('residuo')->insert($datos);
    }
}
