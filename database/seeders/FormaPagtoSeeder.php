<?php

namespace Database\Seeders;

use App\Models\FormaPagto;
use Illuminate\Database\Seeder;

class FormaPagtoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(config('constantes.forma_pagto') as $chave =>$valor){
            FormaPagto::firstOrCreate([
                'id'              => $valor,
                'cod'             => $valor,
                'forma_pagto'     => $chave
            ]);
        }
       
    }
}
