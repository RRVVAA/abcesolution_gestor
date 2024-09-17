<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinComprovanteFatura extends Model
{
    use HasFactory;
    protected $fillable =[
        "empresa_id",
        "fatura_id",
        "data_emissao",
        "data_pagamento",
        "nome_arquivo",
        "confirmado",
        "valor_pago",
        "planopreco_id",
        "descricao",
        "obs"
    ];
    
    public function empresa(){
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
    
    public function fatura(){
        return $this->belongsTo(FinFatura::class, 'fatura_id');
    }
    
    public function planopreco(){
        return $this->belongsTo(PlanoPreco::class, 'planopreco_id');
    }
    
}
