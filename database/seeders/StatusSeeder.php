<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
   
    public function run()
    {
        foreach (config("constantes.status") as $chave=>$valor){
            Status::Create([
                'status'    => $chave,
                'descricao' => $chave,
            ]);
        }
    
        print 'Status Iniciais setados com sucesso';
    }
}
