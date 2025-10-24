<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {      
        DB::table('users')->insert
        ([
            'name' => 'Marcelo Murillo',
            'number' => '+56 9 5555 5557',
            'email' => 'marcelo.murillo.99@hotmail.com',
            'admin_privileges' => true,
            'clasificador' => true,
            'destructor' => true,
            'informatico' => true,
            'publico' => true,
            'reparador' => true,
            'tecnico' => true,
            'trabajador' => true,
            'transportador' => false,
            'upgradeador' => true,
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert
        ([
            'name' => 'Diego Paredes',
            'number' => '+56 9 6233 4354',
            'email' => 'diparcu@gmail.com',
            'admin_privileges' => true,
            'clasificador' => true,
            'destructor' => true,
            'informatico' => true,
            'publico' => true,
            'reparador' => true,
            'tecnico' => true,
            'trabajador' => true,
            'transportador' => true,
            'upgradeador' => true,
            'password' => bcrypt('_1@Dio'),
        ]);
        DB::table('users')->insert([
            'name' => 'Javier Kc',
            'number' => '+56 9 1234 5678',
            'email' => 'kc@gmail.com',
            'destructor' => true,
            'reparador' => true,
            'tecnico' => true,
            'trabajador' => true,
            'transportador' => true,
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'Benjamin Puentes',
            'number' => '+56 9 7752 6335',
            'email' => 'bpuentesgonzalez@gmail.com',
            'admin_privileges' => true,
            'clasificador' => true,
            'destructor' => true,
            'informatico' => true,
            'reparador' => true,
            'tecnico' => true,
            'trabajador' => true,
            'transportador' => false,
            'upgradeador' => true,
            'password' => bcrypt('benj@007'),
        ]);
        DB::table('users')->insert([
            'name' => 'Jean Germain',
            'number' => '+56 9 1234 5679',
            'email' => 'VA.orialco@gmail.com',
            'admin_privileges' => true,
            'clasificador' => true,
            'destructor' => true,
            'tecnico' => true,
            'trabajador' => true,
            'transportador' => false,
            'password' => bcrypt('todoanime1'),
        ]);
        DB::table('users')->insert([
            'name' => 'Frikardo Valenzuela',
            'number' => '+56 9 1234 5670',
            'email' => 'frikardo@gmail.com',
            'informatico' => true,
            'reparador' => true,
            'tecnico' => true,
            'trabajador' => true,
            'upgradeador' => true,
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'Bryan Muñoz',
            'number' => '+56 9 6187 6876',
            'email' => 'bmunoz.rol@gmail.com',
            'admin_privileges' => true,
            'trabajador' => true,
            'upgradeador' => true,
            'password' => bcrypt('mamahuevo10'),
        ]);
        DB::table('users')->insert([
            'name' => 'Alejandra Segura',
            'number' => '+56 9 5678 1234',
            'email' => 'asegura@ubiobio.cl',
            'admin_privileges' => true,
            'clasificador' => true,
            'destructor' => true,
            'informatico' => true,
            'reparador' => true,
            'tecnico' => true,
            'trabajador' => true,
            'transportador' => true,
            'password' => bcrypt('contraseñasegura'),
        ]);
        DB::table('users')->insert([
            'name' => 'Constanza Peters',
            'number' => '+56 9 5678 1234',
            'email' => 'conytha@gmail.cl',
            'admin_privileges' => true,
            'clasificador' => true,
            'destructor' => true,
            'informatico' => true,
            'reparador' => true,
            'tecnico' => true,
            'trabajador' => true,
            'transportador' => true,
            'password' => bcrypt('password'),
        ]);
        /*
        Usuarios solo del rango
        */
        DB::table('users')->insert
        ([
            'name' => 'transportador',
            'number' => '+56 9 1234 5678',
            'email' => 'transportador@gmail.com',
            'admin_privileges' => false,
            'clasificador' => false,
            'destructor' => false,
            'informatico' => false,
            'publico' => false,
            'reparador' => false,
            'tecnico' => false,
            'trabajador' => true,//trabajador
            'transportador' => true,//conductor
            'upgradeador' => false,
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert
        ([
            'name' => 'upgradeador',
            'number' => '+56 9 1234 5678',
            'email' => 'upgradeador@gmail.com',
            'admin_privileges' => false,
            'clasificador' => false,
            'destructor' => false,
            'informatico' => false,
            'publico' => false,
            'reparador' => false,
            'tecnico' => false,
            'trabajador' => true,//trabajador
            'transportador' => false,
            'upgradeador' => true,//upgradeador
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert
        ([
            'name' => 'clasificador',
            'number' => '+56 9 1234 5678',
            'email' => 'clasificador@biobioreciclajes.cl',
            'admin_privileges' => false,
            'clasificador' => true,//clasificador
            'destructor' => false,
            'informatico' => false,
            'publico' => false,
            'reparador' => false,
            'tecnico' => false,
            'trabajador' => true,//trabajador
            'transportador' => false,
            'upgradeador' => false,
            'password' => bcrypt('password'),
        ]);DB::table('users')->insert
        ([
            'name' => 'Constanza Peters',
            'number' => '+56 9 5678 1234',            
            'email' => 'conypeters@gmail.com',
            'admin_privileges' => true,
            'clasificador' => true,
            'destructor' => true,
            'informatico' => true,
            'publico' => true,
            'reparador' => true,
            'tecnico' => true,
            'trabajador' => true,
            'transportador' => true,
            'upgradeador' => true,
            'password' => bcrypt('costie16'),
        ]);
    }
}