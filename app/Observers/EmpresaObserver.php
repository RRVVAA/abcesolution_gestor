<?php

namespace App\Observers;

use App\Models\Empresa;
use Illuminate\Support\Str;

class EmpresaObserver
{
    public function creating(Empresa $tabela)
    {
        $tabela->pasta      = Str::uuid(); 
        $tabela->uuid       = Str::uuid();
        $tabela->cpf_cnpj   = tira_mascara($tabela->cpf_cnpj );
        $tabela->cep        = tira_mascara($tabela->cep );
        $tabela->fone       = tira_mascara($tabela->fone );
        $tabela->celular    = tira_mascara($tabela->celular );
    }
    
    
    public function updating(Empresa $tabela)
    {
        
        $tabela->cpf_cnpj   = tira_mascara($tabela->cpf_cnpj );
        $tabela->cep        = tira_mascara($tabela->cep );
        $tabela->fone       = tira_mascara($tabela->fone );
        $tabela->celular    = tira_mascara($tabela->celular );
        
    }
}
