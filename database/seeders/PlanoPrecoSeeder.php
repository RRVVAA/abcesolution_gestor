<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlanoPreco;

class PlanoPrecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Mensal
        PlanoPreco::Create([
            'plano_id'     => 1,
            'recorrencia'  => 1,
            'preco_de'     => 0,
            'preco'        => 0,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        PlanoPreco::Create([
            'plano_id'     => 2,
            'recorrencia'  => 1,
            'preco_de'     => 49.90,
            'preco'        => 49.90,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        PlanoPreco::Create([
            'plano_id'     => 3,
            'recorrencia'  => 1,
            'preco_de'     => 59.90,
            'preco'        => 59.90,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        PlanoPreco::Create([
            'plano_id'     => 4,
            'recorrencia'  => 1,
            'preco_de'     => 99.90,
            'preco'        => 99.90,
            'status_id'   => config("constantes.status.ATIVO")
        ]);        
        PlanoPreco::Create([
            'plano_id'     => 5,
            'recorrencia'  => 1,
            'preco_de'     => 159.90,
            'preco'        => 159.90,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        
        
        //Trimestral
        PlanoPreco::Create([
            'plano_id'     => 1,
            'recorrencia'  => 3,
            'preco_de'     => 0,
            'preco'        => 0,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        PlanoPreco::Create([
            'plano_id'     => 2,
            'recorrencia'  => 3,
            'preco_de'     => 49.90,
            'preco'        => 44.91,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        PlanoPreco::Create([
            'plano_id'     => 3,
            'recorrencia'  => 3,
            'preco_de'     => 59.90,
            'preco'        => 53.90,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        PlanoPreco::Create([
            'plano_id'     => 4,
            'recorrencia'  => 3,
            'preco_de'     => 99.90,
            'preco'        => 89.91,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        PlanoPreco::Create([
            'plano_id'     => 5,
            'recorrencia'  => 3,
            'preco_de'     => 159.90,
            'preco'        => 143.91,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        
        //Semestral
        PlanoPreco::Create([
            'plano_id'     => 1,
            'recorrencia'  => 6,
            'preco_de'     => 0,
            'preco'        => 0,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        PlanoPreco::Create([
            'plano_id'     => 2,
            'recorrencia'  => 6,
            'preco_de'     => 49.90,
            'preco'        => 42.42,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        PlanoPreco::Create([
            'plano_id'     => 3,
            'recorrencia'  => 6,
            'preco_de'     => 59.90,
            'preco'        => 50.92,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        PlanoPreco::Create([
            'plano_id'     => 4,
            'recorrencia'  => 6,
            'preco_de'     => 99.90,
            'preco'        => 84.92,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        PlanoPreco::Create([
            'plano_id'     => 5,
            'recorrencia'  => 6,
            'preco_de'     => 159.90,
            'preco'        => 135.92,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        
        //Anual
        PlanoPreco::Create([
            'plano_id'     => 1,
            'recorrencia'  => 12,
            'preco_de'     => 0,
            'preco'        => 0,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        PlanoPreco::Create([
            'plano_id'     => 2,
            'recorrencia'  => 12,
            'preco_de'     => 49.90,
            'preco'        => 37.43,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        PlanoPreco::Create([
            'plano_id'     => 3,
            'recorrencia'  => 12,
            'preco_de'     => 59.90,
            'preco'        => 44.93,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        PlanoPreco::Create([
            'plano_id'     => 4,
            'recorrencia'  => 12,
            'preco_de'     => 99.90,
            'preco'        => 74.93,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
        PlanoPreco::Create([
            'plano_id'     => 5,
            'recorrencia'  => 12,
            'preco_de'     => 159.9,
            'preco'        => 119.93,
            'status_id'   => config("constantes.status.ATIVO")
        ]);
    }
}
