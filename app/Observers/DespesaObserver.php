<?php

namespace App\Observers;

use App\Models\GestaoDespesa;

class DespesaObserver
{
    public function creating(GestaoDespesa $tabela)
    {
        $tabela->valor   = getFloat($tabela->valor);
        
    }
    
    
    public function updating(GestaoDespesa $tabela)
    {
        $tabela->valor   = getFloat($tabela->valor);
        
    }
}
