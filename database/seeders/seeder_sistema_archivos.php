<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seeder_sistema_archivos extends Seeder
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

        sistema_archivos::insert($sistemas);
    }
}
