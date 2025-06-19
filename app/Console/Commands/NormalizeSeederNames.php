<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class NormalizeSeederNames extends Command
{
    protected $signature = 'seeders:normalize';
    protected $description = 'Normaliza nombres de seeders al formato Laravel';

    public function handle()
    {
        $seederPath = database_path('seeders');
        
        // Mapeo manual de nombres basado en tus archivos
        $nameMappings = [
            'seeder_almacen' => 'Almacen',
            'seeder_capacidad_ram' => 'CapacidadRam',
            'seeder_ciudad' => 'Ciudad',
            'seeder_descuento' => 'Descuento',
            'seeder_direccion' => 'Direccion',
            'seeder_disco_duro' => 'DiscoDuro',
            'seeder_disponibilidad' => 'Disponibilidad',
            'seeder_estado' => 'Estado',
            'seeder_estado_compra' => 'EstadoCompra',
            'seeder_herramienta' => 'Herramienta',
            'seeder_marca' => 'Marca',
            'seeder_metodo_despacho' => 'MetodoDespacho',
            'seeder_metodo_pago' => 'MetodoPago',
            'seeder_periferico' => 'Periferico',
            'seeder_producto' => 'Producto',
            'seeder_provincia' => 'Provincia',
            'seeder_ram' => 'Ram',
            'seeder_recepcion_estado' => 'RecepcionEstado',
            'seeder_region' => 'Region',
            'seeder_reparacion' => 'Reparacion',
            'seeder_residuo' => 'Residuo',
            'seeder_rol' => 'Rol',
            'seeder_rol_user' => 'RolUser',
            'seeder_sistema_archivos' => 'SistemaArchivos',
            'seeder_tamano_disco_duro' => 'TamanoDiscoDuro',
            'seeder_tamano_ram' => 'TamanoRam',
            'seeder_tarea' => 'Tarea',
            'seeder_tipo_entrada' => 'TipoEntrada',
            'seeder_tipo_periferico' => 'TipoPeriferico',
            'seeder_tipo_ram' => 'TipoRam',
            'seeder_transporte' => 'Transporte',
            'seeder_upgradeo' => 'Upgradeo',
            'seeder_user' => 'User',
            'seeder_velocidad_ram' => 'VelocidadRam',
            'SeederCable' => 'Cable',
            'compra' => 'Compra',
        ];

        foreach ($nameMappings as $old => $new) {
            $oldFile = "$seederPath/$old.php";
            $newFile = "$seederPath/{$new}Seeder.php";
            
            if (file_exists($oldFile)) {
                rename($oldFile, $newFile);
                $this->updateSeederClass($newFile, $new);
                $this->info("Renombrado: $old.php => {$new}Seeder.php");
            }
        }

        $this->info("¡Todos los seeders han sido normalizados!");
    }

    protected function updateSeederClass($path, $modelName)
    {
        $content = file_get_contents($path);
        $newClass = "class {$modelName}Seeder";
        
        // Actualizar nombre de clase
        $content = preg_replace(
            '/class\s+\w+/', 
            $newClass, 
            $content,
            1
        );
        
        file_put_contents($path, $content);
    }
}
