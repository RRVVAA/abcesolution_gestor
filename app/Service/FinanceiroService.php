<?php
namespace App\Service;

use App\Models\FinFatura;
use App\Models\FinPagamento;
use App\Models\GestaoRecebimento;
use App\Models\MovimentoConta;

class FinanceiroService{
    
    public static function inserirRecebimentoDeFatura($fatura_id, $dados){
        $fatura                     = FinFatura::find($fatura_id);
        
        //gerar pagamento para a Empresa
        $pag = new \stdClass();
        $pag->usuario_id              = 1;
        $pag->empresa_id              = $fatura->empresa_id;
        $pag->descricao_pagamento     = "Pagamento da Fatura #" .$fatura->id;
        $pag->forma_pagto_id          = $dados->forma_pagto ;
        $pag->tipo_documento          = config("constantes.tipo_documento.FATURA") ;
        $pag->documento_id            = $fatura->id;
        $pag->fatura_id               = $fatura->id;
        $pag->data_pagamento          = hoje();
        $pag->numero_documento        = $fatura->id;
        $pag->observacao              = "Pagamento de fatura";
        $pag->valor_original          = $fatura->valor;
        $pag->juros                   = 0;
        $pag->desconto                = 0;
        $pag->multa                   = 0;
        $pag->valor_pago              = $fatura->valor;
        $pag->classificacao_financeira_id   = $dados->classificacao_financeira_id; 
        $pag->conta_corrente_id       = $dados->conta_corrente_id ;
        $pagamento                    = FinPagamento::Create(objToArray($pag));
        
        
        //Faz o movimento na Conta
        $mov                                = new \stdClass();
        $mov->empresa_id                    = $fatura->empresa_id;
        $mov->pagamento_id                  = $pagamento->id;
        $mov->conta_id                      = $dados->conta_corrente_id ;
        $mov->classificacao_financeira_id   = $dados->classificacao_financeira_id;
        $mov->documento                     = "Pagamento #".$pagamento->id;
        $mov->data_emissao                  = hoje();
        $mov->data_compensacao              = hoje();
        $mov->tipo_movimento                = "D";
        $mov->historico                     = "Saída de Valor via Pagamento #".$pagamento->id;
        $mov->valor                         = $pagamento->valor_pago;                
        MovimentoConta::Create(objToArray($mov));
        
                
        //gerar Recebimento para o Gestor
        $gestor_receb = new \stdClass();
        $gestor_receb->usuario_id              = 1;
        $gestor_receb->empresa_id              = $fatura->empresa_id;
        $gestor_receb->descricao_recebimento   = "Recebimento da Fatura #" .$fatura->id;
        $gestor_receb->forma_pagto_id          = $dados->forma_pagto ;
        $gestor_receb->tipo_documento          = config("constantes.tipo_documento.FATURA") ;
        $gestor_receb->documento_id            = $fatura->id;
        $gestor_receb->data_recebimento        = hoje();
        $gestor_receb->numero_documento        = $fatura->id;
        $gestor_receb->observacao              = "Recebimento de fatura";
        $gestor_receb->valor_original          = $fatura->valor;
        $gestor_receb->juros                   = 0;
        $gestor_receb->desconto                = 0;
        $gestor_receb->multa                   = 0;
        $gestor_receb->valor_recebido          = $fatura->valor;
        $gestor_recebimento                    = GestaoRecebimento::Create(objToArray($gestor_receb));
        
       // $fatura->pagamento_id                  = $pagamento->id;
        $fatura->status_id                      = config("constantes.status.PAGO");
        $fatura->recebimento_id                 = $gestor_recebimento->id;
        $fatura->data_pagamento                 = hoje();
        $fatura->save();
        
       return $pagamento;
        
    }
    
    public static function inserirContaReceber($id){
        $fatura                     = FinFatura::find($id);
        
        //gerar Recebimento para o Gestor
        $gestor_receb = new \stdClass();
        $gestor_receb->usuario_id              = 1;
        $gestor_receb->descricao_recebimento   = "Recebimento da Fatura #" .$fatura->id;
        $gestor_receb->forma_pagto_id          = 16 ;
        $gestor_receb->tipo_documento          = config("constantes.tipo_recorrencia.FATURA") ;
        $gestor_receb->documento_id            = $fatura->id;
        $gestor_receb->data_recebimento        = hoje();
        $gestor_receb->numero_documento        = $fatura->id;
        $gestor_receb->observacao              = "Pagamento de fatura";
        $gestor_receb->valor_original          = $planopreco->preco;
        $gestor_receb->juros                   = 0;
        $gestor_receb->desconto                = 0;
        $gestor_receb->multa                   = 0;
        $gestor_receb->valor_recebido          = $planopreco->preco;
        $gestor_recebimento                    = GestaoRecebimento::Create(objToArray($gestor_receb));
        
        $fatura->pagamento_id                  = $pagamento->id;
        $fatura->recebimento_id                = $gestor_recebimento->id;
        $fatura->save();
        
        //Alterar o status da empresa
        $empresa                = auth()->user()->empresa;
        
        if($empresa->plano_id   ==1){
            $empresa->data_aquisicao            = hoje();
            $empresa->data_inicial_vencimento   = hoje();
        }
        $empresa->plano_id          = $planopreco->plano_id;
        $empresa->forma_pagto_id    = 16;
        $empresa->valor_recorrente  = $planopreco->preco;
        $empresa->tipo_recorrencia  = $planopreco->recorrencia;
        $empresa->status_id         = config("constantes.status.ATIVO");
        $empresa->data_vencimento   = somarData(hoje(),30 * $planopreco->recorrencia );
        $empresa->save();
        
    }
    
}

