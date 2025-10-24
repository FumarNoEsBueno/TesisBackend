<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CableToProductoSeeder extends Seeder
{
    public function run(): void
    {
        // Traer todos los cables
        $cables = DB::table('cable')->get();

        foreach ($cables as $cable) {
            DB::table('producto')->insert([
                'tipo_objeto' => 'cable',
                'id_objeto'   => $cable->id,
                'fecha'       => Carbon::now()->toDateString(),
                'hora'        => Carbon::now()->toTimeString(),
                'descripcion' => $cable->descripcion ?? 'Sin descripción',
                'peso'        => $cable->peso ?? 0,
                'user_id'     => 1, // Cambia por un user_id válido de tu tabla users
                'estado_id'   => $cable->estado_id, // Copiamos el estado del cable
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
