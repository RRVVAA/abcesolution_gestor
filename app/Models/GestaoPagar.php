<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GestaoPagar extends Model
{
    use HasFactory;
    protected $fillable = [
        "fornecedor_id",
        "status_id",
        "pagamento_id",
        "forma_pagto",
        "descricao",
        "data_lancamento",
        "data_pagamento",
        "data_vencimento",
        "valor_a_pagar",
        "valor_original",
        "valor_pago",
        "juros",
        "desconto",
        "multa",
        "acrescimo",
        "pago"
    ];   
   
    
    public function fornecedor(){
        return $this->belongsTo(GestaoFornecedor::class,"fornecedor_id");
    }
  
    public function pagamento(){
        return $this->belongsTo(GestaoPagamento::class,"pagamento_id");
    }
    public function status(){
        return $this->belongsTo(Status::class,"status_id");
    }
    
    public static function filtroPorData($data1, $data2){
        $retorno = self::whereBetween('data_vencimento',[$data1, $data2]);
        return $retorno;
    }
    
    public static function contasEmAtraso(){
        $contas = self::where('data_vencimento',"<=", hoje())
                        ->select("id","valor","data_vencimento")
                        ->whereNull("pagamento_id");
        
        $retorno = GestaoDespesa::where('data_vencimento',"<=", hoje())
                        ->whereNull("pagamento_id")
                        ->select("id","valor", "data_vencimento")
                        ->union($contas);
        return $retorno;
    }
    
    
    
}
