<?php
namespace App\Service;

use App\Models\FinPagamento;
use App\Models\GestaoRecebimento;
use App\Models\FinFatura;
use App\Models\Assinatura;
use App\Models\FinContaPagar;

class FaturaService
{
    
    public static function gerarParcelas($assinatura_id, $dados){     
        $assinatura = Assinatura::find($assinatura_id);        
        if($assinatura){         
            //Gerar Parcelas
            if($assinatura->planopreco->recorrencia==config("constantes.tipo_recorrencia.MENSAL")){
                $qtde       = 12;
                $mult       = 30;
            }elseif($assinatura->planopreco->recorrencia==config("constantes.tipo_recorrencia.TRIMESTRAL")){
                $qtde       = 3;
                $mult       = 90;
            }elseif($assinatura->planopreco->recorrencia==config("constantes.tipo_recorrencia.SEMESTRAL")){
                $qtde       = 2;
                $mult       = 180;
            }elseif($assinatura->planopreco->recorrencia==config("constantes.tipo_recorrencia.ANUAL")){
                $qtde       = 1;
                $mult       = 360;
            }
            
            for($i = 0; $i<= $qtde; $i++){
                $j = $i+1;
                $fat = new \stdClass();
                $fat->empresa_id    = $assinatura->empresa_id;
                $fat->assinatura_id = $assinatura->id;
                $fat->descricao     = "Fatura #".$j."/".$qtde;                
                $fat->status_id     = config("constantes.status.ABERTO");
                $fat->data_emissao  = hoje();
                $fat->data_vencimento = somarData($assinatura->data_aquisicao,$i * $mult );;
                $fat->valor         = $assinatura->valor_recorrente ;
                $fatura = FinFatura::Create(objToArray($fat));
                if($fatura){
                    $contaPagar = new \stdClass();
                    $contaPagar->empresa_id     = $assinatura->empresa_id;
                    $contaPagar->usuario_id     = 1;
                    $contaPagar->descricao      = "Fatura # " . $fatura->id;
                    $contaPagar->fornecedor_id  = 1;
                    $contaPagar->fatura_id      = $fatura->id;
                    $contaPagar->status_id      = config("constantes.status.ABERTO");
                    $contaPagar->data_emissao   = hoje();
                    $contaPagar->data_vencimento= $fatura->data_vencimento;
                    $contaPagar->origem         = "Fatura";
                    $contaPagar->valor          = $fatura->valor ;
                    $contaPagar->total_juros    = 0;
                    $contaPagar->total_multa    = 0 ;
                    $contaPagar->total_desconto = 0 ;
                    $contaPagar->total_liquido  = $fatura->valor ;
                    $contaPagar->total_recebido = 0 ;
                    $contaPagar->num_parcela = $j ;
                    $contaPagar->ult_parcela = $qtde ;
                    $contaPagar->total_restante = $fatura->valor;
                    $contaPagarNova = FinContaPagar::Create(objToArray($contaPagar));
                    
                    if($i==0){
                        if($dados->pagar_fatura =="S"){
                            //inserir conta receber
                            $retorno = FinanceiroService::inserirRecebimentoDeFatura($fatura->id, $dados);
                            //atualiza Conta Pagar
                            $contaPagarNova->total_restante = 0;
                            $contaPagarNova->total_restante = $fatura->valor ;
                            $contaPagarNova->status_id      = config("constantes.status.PAGO");
                            $contaPagarNova->save();
                            
                            //Ultima fatura paga
                            $assinatura->ultima_fatura_paga= $fatura->id;
                            $assinatura->save();
                        }
                       
                    }
                }
                
            }             
            
        }
    }
    
     
    public static function pagamento($id){
        $fatura                     = FinFatura::find($id);
        
        //gerar pagamento para a Empresa
        $pag = new \stdClass();
        $pag->usuario_id              = 1;
        $pag->descricao_pagamento     = "Pagamento da Fatura #" .$fatura->id;
        $pag->forma_pagto_id          = 16 ;
        $pag->tipo_documento          = config("constantes.tipo_recorrencia.FATURA") ;
        $pag->documento_id            = $fatura->id;        
        $pag->data_pagamento          = hoje();
        $pag->numero_documento        = $fatura->id;
        $pag->observacao              = "Pagamento de fatura";
        $pag->valor_original          = $planopreco->preco;
        $pag->juros                   = 0;
        $pag->desconto                = 0;
        $pag->multa                   = 0;
        $pag->valor_pago              = $planopreco->preco;
        $pagamento                    = FinPagamento::Create(objToArray($pag));      
        
        
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

