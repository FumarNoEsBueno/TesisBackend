<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\tamano_ram;

class seeder_tamano_ram extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tamanos = [
            'PC',
            'Notebook'
        ];

        $tamanos = array_map(function ($tamano) {
            return [
                'tamano_ram_nombre' => $tamano,
            ];
        }, $tamanos);

        tamano_ram::insert($tamanos);
    }
}
