<?php

namespace Database\Seeders;

use App\Models\Plano;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PlanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plano::Create([
            'nome'          => 'Plano Demo',
            'url'           => Str::kebab('Plano Demo'),
            'limite_usuario'=> 1,
            'limite_nfe'    => '5'
        ]);
        Plano::Create([
            'nome'          => 'Plano Básico',
            'url'           => Str::kebab('Plano Básico'),
            'limite_usuario'=> 1,
            'limite_nfe'    => 0
        ]);
        Plano::Create([
            'nome'          => 'Plano Econômico',
            'url'           => Str::kebab('Plano Econômico'),
            'limite_usuario'=> 3,
            'limite_nfe'    => 50
        ]);
        Plano::Create([
            'nome'          => 'Plano Premium',
            'url'           => Str::kebab('Plano Premium'),
            'limite_usuario'=> 5,
            'limite_nfe'    => 100,
            'destaque'    => 'S'
        ]);
        Plano::Create([
            'nome'          => 'Plano Ouro',
            'url'           => Str::kebab('Plano Ouro'),
            'limite_usuario'=> 10,
            'limite_nfe'    => -1
        ]);
        
    }
}
