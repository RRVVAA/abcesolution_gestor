<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmpresaPlano extends Model
{
    use HasFactory;
    protected $fillable = ['empresa_id', 
                            'plano_id', 
                            "status_id",
                            "forma_pagto_id",
                            'data_aquisicao', 
                            "valor_contrato",
                            "data_vencimento",
                            "tipo_recorrencia",
                            "data_inicial_vencimento",
                            "valor_recorrente",
                            "dias_bloqueia"
                            
    ];
    
    
    public function empresa(){
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }    
    
    public function plano(){
        return $this->belongsTo(Plano::class, 'plano_id');
    }
    
    public function status(){
        return $this->belongsTo(Status::class, 'status_id');
    }
    
    public function forma_pagto(){
        return $this->belongsTo(FormaPagto::class, 'forma_pagto_id');
    }
}
