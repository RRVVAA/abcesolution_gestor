<?php

namespace App\Observers;

use App\Models\GestaoReceber;

class ContaReceberObserver
{
    public function creating(GestaoReceber $tabela)
    {
        $tabela->valor   = getFloat($tabela->valor);
        
        
    }
    
    
    public function updating(GestaoReceber $tabela)
    {
        $tabela->valor   = getFloat($tabela->valor);
        
    }
}
