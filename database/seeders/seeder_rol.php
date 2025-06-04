<?php

namespace Database\Seeders;
use App\Models\rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class seeder_rol extends Seeder
{
    public function run(): void
    {
        $datos = [
            'Clasificador',
            'Destructor',
            'Informático',
            'Reparador',
            'Técnico',
            'Transportador',
            'Upgradeador'
        ];

         DB::table('rol')->insert($datos);
    }
}