<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seeder_tarea extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('tareas')->insert([
            [
                'nombre'         => 'Clasificar envases de vidrio',
                'descripcion'    => 'Separar botellas verdes, marrones y transparentes en cajas etiquetadas',
                'tipo_trabajo'   => 'clasificador',
                'nivel_urgencia' => 'medio',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Trituración de documentos',
                'descripcion'    => 'Destruir papel confidencial en la trituradora industrial',
                'tipo_trabajo'   => 'destructor',
                'nivel_urgencia' => 'alto',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Revisión de permisos de usuario',
                'descripcion'    => 'Verificar y actualizar roles de acceso en el sistema',
                'tipo_trabajo'   => 'administrador',
                'nivel_urgencia' => 'alto',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Etiquetado de cajas',
                'descripcion'    => 'Añadir etiquetas con código de producto y fecha de ingreso',
                'tipo_trabajo'   => 'clasificador',
                'nivel_urgencia' => 'bajo',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Eliminación de residuos electrónicos',
                'descripcion'    => 'Desmontar y triturar tarjetas de circuito imprimo',
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
                'tipo_trabajo'   => 'clasificador',
                'nivel_urgencia' => 'medio',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Descontaminación de bidones químicos',
                'descripcion'    => 'Limpiar y neutralizar residuos antes de verterlos',
                'tipo_trabajo'   => 'destructor',
                'nivel_urgencia' => 'alto',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Configurar nuevos usuarios',
                'descripcion'    => 'Crear cuentas, asignar roles y enviar credenciales',
                'tipo_trabajo'   => 'administrador',
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
