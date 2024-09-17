<?php

namespace App\Observers;

use App\Models\GestaoPagar;

class ContaPagarObserver
{
    public function creating(GestaoPagar $tabela)
    {       
        $tabela->valor   = getFloat($tabela->valor);
        
    }
    
    
    public function updating(GestaoPagar $tabela)
    {        
        $tabela->valor   = getFloat($tabela->valor);
        
    }
}
