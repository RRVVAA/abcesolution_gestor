<?php

namespace App\Observers;

use App\Models\GestaoFornecedor;

class FornecedorObserver
{
    public function creating(GestaoFornecedor $tabela)
    {
        
        $tabela->cpf_cnpj   = tira_mascara($tabela->cpf_cnpj ); 
        $tabela->cep        = tira_mascara($tabela->cep ); 
        $tabela->fone       = tira_mascara($tabela->fone );
        $tabela->celular    = tira_mascara($tabela->celular );
    }
    
    
    public function updating(GestaoFornecedor $tabela)
    {        
        $tabela->cpf_cnpj   = tira_mascara($tabela->cpf_cnpj );
        $tabela->cep        = tira_mascara($tabela->cep ); 
        $tabela->fone       = tira_mascara($tabela->fone );
        $tabela->celular    = tira_mascara($tabela->celular );
        
    }
}
