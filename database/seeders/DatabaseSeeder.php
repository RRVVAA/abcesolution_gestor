<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{    
    public function run(){
        $this->call([
            StatusSeeder::class,
            PlanoSeeder::class,
            PlanoPrecoSeeder::class,
            FormaPagtoSeeder::class,
            GestaoGestorSeeder::class,
            EmpresaSeeder::class,
            ModuloSeeder::class,
            PlanoModuloSeeder::class,
        ]);
    }
}
