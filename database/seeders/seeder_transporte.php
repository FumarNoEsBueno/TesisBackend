<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seeder_transporte extends Seeder
{
    public function run(): void
    {               
        DB::table('transporte')->insert
        ([
            //id
            'transporte_solicitante' => 'Jean Germain',
            'transporte_desde' => 'Almacen Hualpen',
            'transporte_hacia' => 'Almacen Nonguen',
            'transporte_cuando' => '23-05.2025',//Fecha DD-MM-AAAA
            'transporte_hora' => '15:40',
            'transporte_descripcion'=> 'Llegar antes de las 4.20',
        ]);        
        DB::table('transporte')->insert
        ([
            'transporte_solicitante' => 'Benjamin Puentes',
            'transporte_desde' => 'Casa dinoplaza',
            'transporte_hacia' => 'Almacen Nonguen',
            'transporte_cuando' => '22-05.2025',//Fecha DD-MM-AAAA            
            'transporte_hora' => '19:20',
            'transporte_descripcion'=> 'Voy de verde',            
        ]);
        DB::table('transporte')->insert
        ([
            'transporte_solicitante' => 'Diego Paredes',
            'transporte_desde' => 'Terminal Collao',
            'transporte_hacia' => 'Almacen Nonguen',
            'transporte_cuando' => '22-05.2025',//Fecha DD-MM-AAAA            
            'transporte_hora' => '19:50',
            'transporte_descripcion'=> 'Voy llegando en bus',            
        ]);
        DB::table('transporte')->insert
        ([
            'transporte_solicitante'   => 'Frikardo Valenzuela',
            'transporte_desde'         => 'Mall Mirador',
            'transporte_hacia'         => 'Almacen Hualpen',
            'transporte_cuando'        => '24-05.2025',
            'transporte_hora'          => '08:30',
            'transporte_descripcion'   => 'Recojo carga ligera',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante'   => 'Jean Germain',
            'transporte_desde'         => 'Almacen Nonguen',
            'transporte_hacia'         => 'Mall del centro',
            'transporte_cuando'        => '26-05.2025',
            'transporte_hora'          => '12:15',
            'transporte_descripcion'   => 'Entregar documentos',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante'   => 'Benjamin Puentes',
            'transporte_desde'         => 'La dinoplaza',
            'transporte_hacia'         => 'Almacen Hualpen',
            'transporte_cuando'        => '27-05.2025',
            'transporte_hora'          => '10:00',
            'transporte_descripcion'   => 'Traer repuestos',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante'   => 'Diego Paredes',
            'transporte_desde'         => '[ -36.8374, -73.0442 ]',
            'transporte_hacia'         => 'Almacen Nonguen',
            'transporte_cuando'        => '28-05.2025',
            'transporte_hora'          => '14:45',
            'transporte_descripcion'   => 'Coordenadas exactas',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante'   => 'Frikardo Valenzuela',
            'transporte_desde'         => 'Mall del centro',
            'transporte_hacia'         => 'Almacen Nonguen',
            'transporte_cuando'        => '24-05.2025',
            'transporte_hora'          => '18:05',
            'transporte_descripcion'   => 'Carga pesada, revisar límites',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante'   => 'Jean Germain',
            'transporte_desde'         => 'Mall Mirador',
            'transporte_hacia'         => '[ -36.8175, -73.0440 ]',
            'transporte_cuando'        => '26-05.2025',
            'transporte_hora'          => '16:00',
            'transporte_descripcion'   => 'Destino con coordenadas',
        ]);
    }
}