<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SistemaArchivos;

class SistemaArchivosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sistemas = [
            'NTFS',
            'Ext4',
            'Fat32',
            'ExFat'
        ];

        $sistemas = array_map(function ($sistema) {
            return [
                'sistema_archivos_nombre' => $sistema,
            ];
        }, $sistemas);

        SistemaArchivos::insert($sistemas);
    }
}
