<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Tarea; 

class TareaSeeder extends Seeder
{
    public function run()
    {
        DB::table('tarea')->insert([
            [
                'nombre'         => 'Clasificar teclados en buenos y malos',
                'descripcion'    => 'Separar teclados funcionales de los que no funcionan',
                'tipo_trabajo'   => 'clasificador',
                'nivel_urgencia' => 'bajo',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Ordenar',
                'descripcion'    => 'Identificar objetos y áreas disponibles para almacenar nuevos productos',
                'tipo_trabajo'   => 'clasificador',
                'nivel_urgencia' => 'alto',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Revisión de permisos de usuarios',
                'descripcion'    => 'Crear y actualizar roles de acceso en el sistema',
                'tipo_trabajo'   => 'informatico',
                'nivel_urgencia' => 'medio',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Etiquetado de pantallas',
                'descripcion'    => 'Añadir etiquetas con identificado de producto y estado',
                'tipo_trabajo'   => 'clasificador',
                'nivel_urgencia' => 'bajo',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Eliminación de residuo electrónico',
                'descripcion'    => 'Desmontar y triturar chatarra para clasificar metales',
                'tipo_trabajo'   => 'destructor',
                'nivel_urgencia' => 'medio',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Generar informe mensual',
                'descripcion'    => 'Compilar estadísticas de uso y generar PDF de reporte',
                'tipo_trabajo'   => 'administrador',
                'nivel_urgencia' => 'medio',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Separar metales ferrosos',
                'descripcion'    => 'Usar imán para distinguir chatarra ferrosa en la pila',
                'tipo_trabajo'   => 'destructor',
                'nivel_urgencia' => 'medio',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Depurar aluminio',
                'descripcion'    => 'Usar imán para distinguir chatarra ferrosa en la pila de aluminio',
                'tipo_trabajo'   => 'destructor',
                'nivel_urgencia' => 'medio',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Disolución quimica, obtencion de metales',
                'descripcion'    => 'Limpiar y neutralizar residuo antes de verterlos. Obtener metales puros',
                'tipo_trabajo'   => 'destructor',
                'nivel_urgencia' => 'alto',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Reparar y testear impresoras',
                'descripcion'    => 'Las impresoras que no funcionan deben ser reparadas y probadas',
                'tipo_trabajo'   => 'reparador',
                'nivel_urgencia' => 'bajo',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Organizar resistencia de pilas',
                'descripcion'    => 'Clasificar pilas alcalinas y de litio por tamaño y estado',
                'tipo_trabajo'   => 'clasificador',
                'nivel_urgencia' => 'alto',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }

}
