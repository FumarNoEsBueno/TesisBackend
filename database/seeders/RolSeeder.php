<?php

namespace Database\Seeders;
use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
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