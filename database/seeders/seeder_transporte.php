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
            //table
            'transporte_desde' => 'Casa hualpen',
            'transporte_hacia' => 'Casa nonguen',
            'transporte_cuando' => 'mañana a las 8AM',
            'transporte_descripcion'=> 'Voy de rojo',
        ]);        
        DB::table('transporte')->insert
        ([
            'transporte_desde' => 'Casa esquina',
            'transporte_hacia' => 'Casa del cerro',
            'transporte_cuando' => 'mañana a las 4.20PM',
            'transporte_hora' => '16:20',
            'transporte_descripcion'=> 'Voy de verde',
        ]);
        
    }
}