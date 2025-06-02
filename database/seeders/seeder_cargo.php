<?php

namespace Database\Seeders;
use App\Models\cargo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class seeder_cargo extends Seeder
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

         DB::table('cargo')->insert($datos);
    }
}