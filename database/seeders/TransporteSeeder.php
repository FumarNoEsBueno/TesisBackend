<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransporteSeeder extends Seeder
{
    public function run(): void
    {               
        DB::table('transporte')->insert
        ([
            //id
            'transporte_solicitante' => 'Jean Germain',
            'transporte_desde' => 'almacen Hualpen',
            'transporte_hacia' => 'almacen Nonguen',
            'transporte_cuando' => '23-05-2025',//Fecha DD-MM-AAAA
            'transporte_hora' => '15:40',
            'transporte_descripcion'=> 'Llegar antes de las 4.20',
        ]);        
        DB::table('transporte')->insert
        ([
            'transporte_solicitante' => 'Benjamin Puentes',
            'transporte_desde' => 'Casa dinoplaza',
            'transporte_hacia' => 'almacen Nonguen',
            'transporte_cuando' => '22-05-2025',//Fecha DD-MM-AAAA            
            'transporte_hora' => '19:20',
            'transporte_descripcion'=> 'Voy de verde',            
        ]);
        DB::table('transporte')->insert
        ([
            'transporte_solicitante' => 'Diego Paredes',
            'transporte_desde' => 'Terminal Collao',
            'transporte_hacia' => 'almacen Nonguen',
            'transporte_cuando' => '22-05-2025',//Fecha DD-MM-AAAA            
            'transporte_hora' => '19:50',
            'transporte_descripcion'=> 'Voy llegando en bus',            
        ]);
        DB::table('transporte')->insert
        ([
            'transporte_solicitante'   => 'Frikardo Valenzuela',
            'transporte_desde'         => 'Mall Mirador',
            'transporte_hacia'         => 'almacen Hualpen',
            'transporte_cuando'        => '24-05-2025',
            'transporte_hora'          => '08:30',
            'transporte_descripcion'   => 'Recojo carga ligera',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante'   => 'Jean Germain',
            'transporte_desde'         => 'almacen Nonguen',
            'transporte_hacia'         => 'Mall del centro',
            'transporte_cuando'        => '26-05-2025',
            'transporte_hora'          => '12:15',
            'transporte_descripcion'   => 'Entregar documentos',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante'   => 'Benjamin Puentes',
            'transporte_desde'         => 'La dinoplaza',
            'transporte_hacia'         => 'almacen Hualpen',
            'transporte_cuando'        => '27-05-2025',
            'transporte_hora'          => '10:00',
            'transporte_descripcion'   => 'Traer repuestos',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante'   => 'Diego Paredes',
            'transporte_desde'         => '[ -36.8374, -73.0442 ]',
            'transporte_hacia'         => 'almacen Nonguen',
            'transporte_cuando'        => '28-05-2025',
            'transporte_hora'          => '14:45',
            'transporte_descripcion'   => 'Coordenadas exactas',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante'   => 'Frikardo Valenzuela',
            'transporte_desde'         => 'Mall del centro',
            'transporte_hacia'         => 'almacen Nonguen',
            'transporte_cuando'        => '24-05-2025',
            'transporte_hora'          => '18:05',
            'transporte_descripcion'   => 'Carga pesada, revisar límites',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante'   => 'Jean Germain',
            'transporte_desde'         => 'Mall Mirador',
            'transporte_hacia'         => '[ -36.8175, -73.0440 ]',
            'transporte_cuando'        => '26-05-2025',
            'transporte_hora'          => '16:00',
            'transporte_descripcion'   => 'Destino con coordenadas',
        ]);
                DB::table('transporte')->insert([
            'transporte_solicitante'   => 'Diego Paredes',
            'transporte_desde'         => 'Universidad del Bío-Bío',
            'transporte_hacia'         => 'almacen Nonguen',
            'transporte_cuando'        => '29-05-2025',
            'transporte_hora'          => '09:30',
            'transporte_descripcion'   => 'Llevar notebook de respaldo',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante'   => 'Benjamin Puentes',
            'transporte_desde'         => 'Plaza Acevedo',
            'transporte_hacia'         => 'La dinoplaza',
            'transporte_cuando'        => '29-05-2025',
            'transporte_hora'          => '13:15',
            'transporte_descripcion'   => 'Reunión con proveedor',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante'   => 'Frikardo Valenzuela',
            'transporte_desde'         => 'Estación Biotren Hualqui',
            'transporte_hacia'         => 'almacen Hualpen',
            'transporte_cuando'        => '30-05-2025',
            'transporte_hora'          => '11:45',
            'transporte_descripcion'   => 'Viaje de inspección',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante'   => 'Jean Germain',
            'transporte_desde'         => 'Terminal de buses Collao',
            'transporte_hacia'         => 'Planta de reciclaje',
            'transporte_cuando'        => '30-05-2025',
            'transporte_hora'          => '17:10',
            'transporte_descripcion'   => 'Entrega urgente de piezas',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Jean Germain',
            'transporte_desde' => 'almacen Hualpen',
            'transporte_hacia' => 'almacen Nonguen',
            'transporte_cuando' => '07-06-2025',
            'transporte_hora' => '10:00',
            'transporte_descripcion' => 'Llevar herramientas nuevas',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Benjamin Puentes',
            'transporte_desde' => 'La dinoplaza',
            'transporte_hacia' => 'Mall del centro',
            'transporte_cuando' => '08-06-2025',
            'transporte_hora' => '11:15',
            'transporte_descripcion' => 'Entrega de presupuesto',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Diego Paredes',
            'transporte_desde' => 'Terminal Collao',
            'transporte_hacia' => 'almacen Hualpen',
            'transporte_cuando' => '09-06-2025',
            'transporte_hora' => '14:00',
            'transporte_descripcion' => 'Revisión de componentes',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Frikardo Valenzuela',
            'transporte_desde' => 'Universidad del Bío-Bío',
            'transporte_hacia' => 'almacen Nonguen',
            'transporte_cuando' => '10-06-2025',
            'transporte_hora' => '08:30',
            'transporte_descripcion' => 'Llevar material de laboratorio',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Jean Germain',
            'transporte_desde' => 'Planta de reciclaje',
            'transporte_hacia' => 'Mall Mirador',
            'transporte_cuando' => '11-06-2025',
            'transporte_hora' => '16:45',
            'transporte_descripcion' => 'Reunión externa',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Benjamin Puentes',
            'transporte_desde' => 'Casa dinoplaza',
            'transporte_hacia' => 'Estación Biotren',
            'transporte_cuando' => '12-06-2025',
            'transporte_hora' => '09:10',
            'transporte_descripcion' => 'Visita técnica',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Diego Paredes',
            'transporte_desde' => 'Plaza Acevedo',
            'transporte_hacia' => 'almacen Nonguen',
            'transporte_cuando' => '13-06-2025',
            'transporte_hora' => '13:30',
            'transporte_descripcion' => 'Llevar pieza crítica',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Frikardo Valenzuela',
            'transporte_desde' => 'Mall Mirador',
            'transporte_hacia' => 'Terminal Collao',
            'transporte_cuando' => '14-06-2025',
            'transporte_hora' => '10:50',
            'transporte_descripcion' => 'Enlace con transporte externo',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Jean Germain',
            'transporte_desde' => 'Mall del centro',
            'transporte_hacia' => 'almacen Hualpen',
            'transporte_cuando' => '15-06-2025',
            'transporte_hora' => '17:20',
            'transporte_descripcion' => 'Entrega de informe',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Benjamin Puentes',
            'transporte_desde' => 'Planta de reciclaje',
            'transporte_hacia' => 'Mall Mirador',
            'transporte_cuando' => '16-06-2025',
            'transporte_hora' => '11:00',
            'transporte_descripcion' => 'Distribuir folletos',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Diego Paredes',
            'transporte_desde' => 'Universidad del Bío-Bío',
            'transporte_hacia' => 'almacen Hualpen',
            'transporte_cuando' => '17-06-2025',
            'transporte_hora' => '15:45',
            'transporte_descripcion' => 'Entregar código fuente',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Frikardo Valenzuela',
            'transporte_desde' => 'almacen Nonguen',
            'transporte_hacia' => 'Mall del centro',
            'transporte_cuando' => '18-06-2025',
            'transporte_hora' => '12:30',
            'transporte_descripcion' => 'Buscar cliente',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Jean Germain',
            'transporte_desde' => 'Terminal Collao',
            'transporte_hacia' => 'almacen Nonguen',
            'transporte_cuando' => '19-06-2025',
            'transporte_hora' => '09:55',
            'transporte_descripcion' => 'Llegada desde Santiago',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Benjamin Puentes',
            'transporte_desde' => 'Casa dinoplaza',
            'transporte_hacia' => 'Mall Mirador',
            'transporte_cuando' => '20-06-2025',
            'transporte_hora' => '08:20',
            'transporte_descripcion' => 'Llevar uniformes',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Diego Paredes',
            'transporte_desde' => 'Plaza Perú',
            'transporte_hacia' => 'Planta de reciclaje',
            'transporte_cuando' => '21-06-2025',
            'transporte_hora' => '18:00',
            'transporte_descripcion' => 'Revisión de sistemas',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Frikardo Valenzuela',
            'transporte_desde' => 'Mall Mirador',
            'transporte_hacia' => 'almacen Hualpen',
            'transporte_cuando' => '22-06-2025',
            'transporte_hora' => '16:30',
            'transporte_descripcion' => 'Reunión con jefatura',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Jean Germain',
            'transporte_desde' => 'Mall del centro',
            'transporte_hacia' => 'Estación Biotren',
            'transporte_cuando' => '23-06-2025',
            'transporte_hora' => '07:50',
            'transporte_descripcion' => 'Salida hacia Chillán',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Benjamin Puentes',
            'transporte_desde' => 'Universidad del Bío-Bío',
            'transporte_hacia' => 'almacen Nonguen',
            'transporte_cuando' => '24-06-2025',
            'transporte_hora' => '12:40',
            'transporte_descripcion' => 'Presentación de proyecto',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Diego Paredes',
            'transporte_desde' => '[ -36.8261, -73.0495 ]',
            'transporte_hacia' => 'almacen Nonguen',
            'transporte_cuando' => '25-06-2025',
            'transporte_hora' => '10:05',
            'transporte_descripcion' => 'Usar coordenadas GPS',
        ]);
        DB::table('transporte')->insert([
            'transporte_solicitante' => 'Frikardo Valenzuela',
            'transporte_desde' => 'Mall del centro',
            'transporte_hacia' => 'La dinoplaza',
            'transporte_cuando' => '26-06-2025',
            'transporte_hora' => '17:40',
            'transporte_descripcion' => 'Llevar archivo físico',
        ]);
        DB::table('transporte')->insert([
            ['transporte_solicitante' => 'Alejandra Segura', 'transporte_desde' => 'Casa Segura', 'transporte_hacia' => 'UBB', 'transporte_cuando' => '03-06-2025', 'transporte_hora' => '08:00', 'transporte_descripcion' => 'Traslado a clases'],
            ['transporte_solicitante' => 'Alejandra Segura', 'transporte_desde' => 'UBB', 'transporte_hacia' => 'Casa Segura', 'transporte_cuando' => '03-06-2025', 'transporte_hora' => '18:00', 'transporte_descripcion' => 'Retorno desde clases'],
            ['transporte_solicitante' => 'Alejandra Segura', 'transporte_desde' => 'Casa Segura', 'transporte_hacia' => 'UBB', 'transporte_cuando' => '06-06-2025', 'transporte_hora' => '08:00', 'transporte_descripcion' => 'Traslado a clases'],
            ['transporte_solicitante' => 'Alejandra Segura', 'transporte_desde' => 'UBB', 'transporte_hacia' => 'Casa Segura', 'transporte_cuando' => '06-06-2025', 'transporte_hora' => '18:00', 'transporte_descripcion' => 'Retorno desde clases'],
            ['transporte_solicitante' => 'Alejandra Segura', 'transporte_desde' => 'Casa Segura', 'transporte_hacia' => 'UBB', 'transporte_cuando' => '10-06-2025', 'transporte_hora' => '08:00', 'transporte_descripcion' => 'Traslado a clases'],
            ['transporte_solicitante' => 'Alejandra Segura', 'transporte_desde' => 'UBB', 'transporte_hacia' => 'Casa Segura', 'transporte_cuando' => '10-06-2025', 'transporte_hora' => '18:00', 'transporte_descripcion' => 'Retorno desde clases'],
            ['transporte_solicitante' => 'Alejandra Segura', 'transporte_desde' => 'Casa Segura', 'transporte_hacia' => 'UBB', 'transporte_cuando' => '13-06-2025', 'transporte_hora' => '08:00', 'transporte_descripcion' => 'Traslado a clases'],
            ['transporte_solicitante' => 'Alejandra Segura', 'transporte_desde' => 'UBB', 'transporte_hacia' => 'Casa Segura', 'transporte_cuando' => '13-06-2025', 'transporte_hora' => '18:00', 'transporte_descripcion' => 'Retorno desde clases'],
            ['transporte_solicitante' => 'Alejandra Segura', 'transporte_desde' => 'Casa Segura', 'transporte_hacia' => 'UBB', 'transporte_cuando' => '17-06-2025', 'transporte_hora' => '08:00', 'transporte_descripcion' => 'Traslado a clases'],
            ['transporte_solicitante' => 'Alejandra Segura', 'transporte_desde' => 'UBB', 'transporte_hacia' => 'Casa Segura', 'transporte_cuando' => '17-06-2025', 'transporte_hora' => '18:00', 'transporte_descripcion' => 'Retorno desde clases'],
        ]);

    }
}