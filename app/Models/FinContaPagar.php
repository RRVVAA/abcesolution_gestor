<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinContaPagar extends Model
{
    use HasFactory;
    protected $fillable =[
        "empresa_id",
        "despesa_id",
        "fatura_id",
        "total_juros",
        "total_multa",
        "total_desconto",
        "total_liquido",
        "total_recebido",
        "total_restante",
        "descricao",
        "fornecedor_id",
        "compra_id",
        "centro_custo_id",
        "num_parcela",
        "ult_parcela",
        "data_emissao",
        "data_vencimento",
        "observacao",
        "valor",
        "status_id",
        "origem",
        "nfe_id"
    ];
    
    public function empresa(){
        return $this->belongsTo(Empresa::class,"empresa_id");
    }
    
    public function pagamento(){
        return $this->belongsTo(FinPagamento::class, 'pagamento_id');
    }
   
    
    public function status(){
        return $this->belongsTo(Status::class,"status_id");
    }  
   
    public function forma_pagto(){
        return $this->belongsTo(FormaPagto::class,"forma_pagto_id","id");
    }
   
}
