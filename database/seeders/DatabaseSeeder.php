<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(CapacidadRamSeeder::class);
        $this->call(DescuentoSeeder::class);
        $this->call(RecepcionEstadoSeeder::class);
        $this->call(EstadoCompraSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(ProvinciaSeeder::class);
        $this->call(CiudadSeeder::class);
        $this->call(DireccionSeeder::class);
        $this->call(AlmacenSeeder::class);
        $this->call(TamanoDiscoDuroSeeder::class);
        $this->call(TamanoRamSeeder::class);
        $this->call(TipoEntradaSeeder::class);
        $this->call(TipoPerifericoSeeder::class);
        $this->call(TipoRamSeeder::class);
        $this->call(VelocidadRamSeeder::class);
        $this->call(SistemaArchivosSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(DisponibilidadSeeder::class);
        $this->call(PerifericoSeeder::class);
        $this->call(CableSeeder::class);
        $this->call(DiscoDuroSeeder::class);
        $this->call(RamSeeder::class);
        $this->call(MetodoPagoSeeder::class);
        $this->call(MetodoDespachoSeeder::class);
        $this->call(TransporteSeeder::class);
        $this->call(TareaSeeder::class);
        $this->call(ResiduoSeeder::class);
        $this->call(ReparacionSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(HerramientaSeeder::class);
        $this->call(UpgradeoSeeder::class);
        $this->call(CableFotoSeeder::class);
        
        // Relle
        $this->call(CableToProductoSeeder::class);

    }
}

