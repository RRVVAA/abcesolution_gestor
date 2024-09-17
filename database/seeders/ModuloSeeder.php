<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modulo;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {      
        Modulo::Create([
            'nome'          => 'Venda',
        ]);
        
        Modulo::Create([
            'nome'          => 'Compra',
        ]);
        
        Modulo::Create([
            'nome'          => 'Loja Virtual',
        ]);
        
        Modulo::Create([
            'nome'          => 'Nfe',
        ]);
        Modulo::Create([
            'nome'          => 'PDV',
        ]);
        Modulo::Create([
            'nome'          => 'Pedidos',
        ]);
        
        Modulo::Create([
            'nome'          => 'Contas a Pagar',
        ]);
        
        Modulo::Create([
            'nome'          => 'Contas a Receber',
        ]);
        
      /*  Modulo::Create([
            'nome'          => 'Delivery',
        ]);
        
        Modulo::Create([
            'nome'          => 'Comandas',
        ]);
        
       */
       
    }
}
