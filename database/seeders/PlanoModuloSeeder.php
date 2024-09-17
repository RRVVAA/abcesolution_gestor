<?php

namespace Database\Seeders;

use App\Models\PlanoModulo;
use Illuminate\Database\Seeder;

class PlanoModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     */
    public function run()
    {
        PlanoModulo::Create([
            'plano_id'    => 1,
            'modulo_id'  => 1
        ]);
        
        PlanoModulo::Create([
            'plano_id'    => 1,
            'modulo_id'  => 2
        ]);
        
        PlanoModulo::Create([
            'plano_id'    => 1,
            'modulo_id'  => 3
        ]);
        
        PlanoModulo::Create([
            'plano_id'    => 1,
            'modulo_id'  => 4
        ]);
        
        PlanoModulo::Create([
            'plano_id'    => 1,
            'modulo_id'  => 5
        ]);
        
        PlanoModulo::Create([
            'plano_id'    => 1,
            'modulo_id'  => 6
        ]);
        
        PlanoModulo::Create([
            'plano_id'    => 1,
            'modulo_id'  => 7
        ]);
        
        PlanoModulo::Create([
            'plano_id'    => 1,
            'modulo_id'  => 8
        ]);
    }
}
