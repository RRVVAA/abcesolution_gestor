<?php

namespace App\Observers;


use App\Models\GestaoRecebimento;

class RecebimentoObserver
{
    public function creating(GestaoRecebimento $tabela)
    {
        $tabela->valor_original = getFloat($tabela->valor_original);
        $tabela->valor_recebido = getFloat($tabela->valor_recebido);
        $tabela->juros          = getFloat($tabela->juros);
        $tabela->desconto       = getFloat($tabela->desconto);
        $tabela->multa          = getFloat($tabela->multa);
        
    }
    
    
    public function updating(GestaoRecebimento $tabela)
    {
        $tabela->valor_original = getFloat($tabela->valor_original);
        $tabela->valor_recebido = getFloat($tabela->valor_recebido);
        $tabela->juros          = getFloat($tabela->juros);
        $tabela->desconto       = getFloat($tabela->desconto);
        $tabela->multa          = getFloat($tabela->multa);
        
    }
}
