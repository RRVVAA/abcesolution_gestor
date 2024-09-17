<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinFatura extends Model
{
    use HasFactory;
    protected $table = "fin_faturas";
    protected $fillable =[
        "empresa_id",
        "pagamento_id",
        "recebimento_id",
        "assinatura_id",
        "planopreco_id",
        "descricao",
        "forma_pagto_id",
        "status_id",
        "data_emissao",
        "data_vencimento",
        "data_pagamento",
        "observacao",
        "valor",
        "status_id",
        "num_fatura",
        "inicio_vigencia",
        "fim_vigencia",
        "data_cancelamento"
    ];
    
    public function empresa(){
        return $this->belongsTo(Empresa::class,"empresa_id");
    }
    
    public function planopreco(){
        return $this->belongsTo(PlanoPreco::class,"planopreco_id");
    }
    public function pagamento(){
        return $this->belongsTo(FinPagamento::class,"pagamento_id");
    }
    
    public function recebimento(){
        return $this->belongsTo(GestaoRecebimento::class,"pagamento_id");
    }
    
    public function forma_pagto(){
        return $this->belongsTo(FormaPagto::class,"forma_pagto_id");
    }
    
    public function status(){
        return $this->belongsTo(Status::class,"status_id");
    }
    public static function filtroPorData($data1, $data2){
        $retorno = self::whereBetween('data_vencimento',[$data1, $data2]);
        return $retorno;
    }
    public static function confirmarPagamento($id_fatura){        
        $fatura  = FinFatura::find($id_fatura);
        $empresa = Empresa::find($fatura->empresa_id);
        
        //gerar pagamento para a Empresa
        $pag = new \stdClass();
        $pag->empresa_id                = $fatura->empresa_id;
        $pag->usuario_id                = 1;
        $pag->descricao_pagamento       = "Pagamento da Fatura #" .$fatura->id;
        $pag->forma_pagto_id            = 16 ;
        $pag->tipo_documento            = config("constantes.tipo_recorrencia.FATURA") ;
        $pag->documento_id              = $fatura->id;
        $pag->data_pagamento            = hoje();
        $pag->numero_documento          = $fatura->id;
        $pag->observacao                = "Pagamento de fatura";
        $pag->valor_original            = $fatura->valor;
        $pag->valor_pago                = $fatura->valor;
        $pagamento                      = FinPagamento::Create(objToArray($pag));
        
        //Gerar Recebimento para o Gestor
        $gestor_receb                          = new \stdClass();
        $gestor_receb->empresa_id              = $fatura->empresa_id;
        $gestor_receb->usuario_id              = 1;
        $gestor_receb->descricao_recebimento   = "Recebimento da Fatura #" .$fatura->id;
        $gestor_receb->forma_pagto_id          = 16 ;
        $gestor_receb->tipo_documento          = config("constantes.tipo_recorrencia.FATURA") ;
        $gestor_receb->documento_id            = $fatura->id;
        $gestor_receb->data_recebimento        = hoje();
        $gestor_receb->numero_documento        = $fatura->id;
        $gestor_receb->observacao              = "Pagamento de fatura";
        $gestor_receb->valor_original          = $fatura->valor;
        $gestor_receb->juros                   = 0;
        $gestor_receb->desconto                = 0;
        $gestor_receb->multa                   = 0;
        $gestor_receb->valor_recebido          = $fatura->valor;
        $gestor_recebimento                    = GestaoRecebimento::Create(objToArray($gestor_receb));        
        
        $fatura->pagamento_id                 = $pagamento->id;
        $fatura->recebimento_id               = $gestor_recebimento->id;
        $fatura->status_id                    = config("constantes.status.PAGO");
        $fatura->save();
        
        $fatura_em_aberto                      = FinFatura::where(["empresa_id"=>$fatura->empresa_id, "status_id" => config("constantes.status.ABERTO")])->first();
        if(!$fatura_em_aberto){
            $empresa->status_plano_id          =  config("constantes.status.EM_DIAS");
        }
        //Alterar o status da empresa
        $empresa->data_vencimento             = somarData($fatura->data_vencimento,30 * $empresa->planopreco->recorrencia );        
        $empresa->save();
        
        return $pagamento;
    }
    public static function filtro($filtro){
        $retorno = FinFatura::orderBy('fin_faturas.data_vencimento', 'asc');       
        
        if($filtro->status_id){
            $retorno->where("status_id", $filtro->status_id);
        }
        
        if($filtro->venc01){
            if($filtro->venc02){
                $retorno->where("data_vencimento",">=", $filtro->venc01)->where("data_vencimento","<=", $filtro->venc02);
            }else{
                $retorno->where("data_vencimento", $filtro->venc01);
            }
        }
        
        if($filtro->emissao01){
            if($filtro->emissao02){
                $retorno->where("data_emissao",">=", $filtro->emissao01)->where("data_emissao","<=", $filtro->emissao02);
            }else{
                $retorno->where("data_emissao", $filtro->emissao01);
            }
        }
        
        return $retorno->get();
    }
}
