<?php

namespace App\Observers;

use App\Models\Plano;
use Illuminate\Support\Str;

class PlanoObserver
{
    public function creating(Plano $tabela)
    {
        $tabela->url = Str::kebab($tabela->nome);      
    }
    
    
    public function updating(Plano $tabela)
    {
        $tabela->url = Str::kebab($tabela->nome);       
    }
}
