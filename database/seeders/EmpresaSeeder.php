<?php

namespace Database\Seeders;

use App\Models\PlanoPreco;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plano = PlanoPreco::first();
        
        $plano->empresas()->create([
            'razao_social'          =>  'Sistema',
            'cpf_cnpj'              =>  '12345678',
            'fone'                  =>  '9898988989',
            'pasta'                 =>  '102030405060',
            'email'                 =>  'sistema@sistema.com.br',
            'cep'                   =>  '22040002',
            'logradouro'            =>  'Rua',
            'numero'                =>  '191',
            'uf'                    =>  'MA',
            'cidade'                =>  'Cidade',
            'bairro'                =>  'Bairro',
            'status_id'             =>  config("constantes.status.ATIVO"),
            'status_plano_id'       =>  config("constantes.status.EM_DIAS"), 
            "forma_pagto_id"        =>  1,
            "plano_preco_id"        =>  $plano->id,
            "data_aquisicao"        =>  date("Y-m-d"),
            "valor_contrato"        =>  0,
           "data_vencimento"       =>  somarData(date("Y-m-d"),15),
           "data_inicial_vencimento"=> date("Y-m-d"),
            "valor_recorrente"  =>0,
            "dias_bloqueia"     =>0            
        ]);
        
    }
}
