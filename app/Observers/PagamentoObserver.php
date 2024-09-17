<?php

namespace App\Observers;

use App\Models\GestaoPagamento;

class PagamentoObserver
{
    public function creating(GestaoPagamento $tabela)
    {
        $tabela->valor_original = getFloat($tabela->valor_original);
        $tabela->valor_pago     = getFloat($tabela->valor_pago);
        $tabela->juros          = getFloat($tabela->juros);
        $tabela->desconto       = getFloat($tabela->desconto);
        $tabela->multa          = getFloat($tabela->multa);
        
    }
    
    
    public function updating(GestaoPagamento $tabela)
    {
        $tabela->valor_original = getFloat($tabela->valor_original);
        $tabela->valor_pago     = getFloat($tabela->valor_pago);
        $tabela->juros          = getFloat($tabela->juros);
        $tabela->desconto       = getFloat($tabela->desconto);
        $tabela->multa          = getFloat($tabela->multa);
        
    }
}
