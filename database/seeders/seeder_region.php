<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\region;

class seeder_region extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regiones = [
            'Arica y Parinacota',
            'Tarapacá',
            'Antofagasta',
            'Atacama',
            'Coquimbo',
            'Valparaiso',
            'Metropolitana de Santiago',
            'Libertador General Bernardo OHiggins',
            'Maule',
            'Ñuble',
            'Biobío',
            'La Araucanía',
            'Los Ríos',
            'Los Lagos',
            'Aisén del General Carlos Ibáñez del Campo',
            'Magallanes y de la Antártica Chilena'
        ];

        $regiones = array_map(function ($region) {
            return [
                'region_nombre' => $region,
            ];
        }, $regiones);

        region::insert($regiones);
    }
}
