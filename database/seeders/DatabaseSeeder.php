<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(seeder_user::class);
        $this->call(seeder_capacidad_ram::class);
        $this->call(seeder_descuento::class);
        $this->call(seeder_recepcion_estado::class);
        $this->call(seeder_estado_compra::class);
        $this->call(seeder_region::class);
        $this->call(seeder_provincia::class);
        $this->call(seeder_ciudad::class);
        $this->call(seeder_direccion::class);
        $this->call(seeder_almacen::class);
        $this->call(seeder_tamano_disco_duro::class);
        $this->call(seeder_tamano_ram::class);
        $this->call(seeder_tipo_entrada::class);
        $this->call(seeder_tipo_periferico::class);
        $this->call(seeder_tipo_ram::class);
        $this->call(seeder_velocidad_ram::class);
        $this->call(seeder_sistema_archivos::class);
        $this->call(seeder_marca::class);
        $this->call(seeder_estado::class);
        $this->call(seeder_disponibilidad::class);
        $this->call(seeder_periferico::class);
        $this->call(seeder_disco_duro::class);
        $this->call(seeder_cable::class);
        $this->call(seeder_ram::class);
        $this->call(seeder_metodo_pago::class);
        $this->call(seeder_metodo_despacho::class);
        //Diego was here
        $this->call(seeder_transporte::class);
        $this->call(seeder_tarea::class);
        $this->call(seeder_residuo::class);
        $this->call(seeder_reparacion::class);
        $this->call(seeder_producto::class);
        

    }
}

