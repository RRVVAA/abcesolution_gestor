<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    public $fillable = ['razao_social', 'subdominio', 'pasta', 'cpf_cnpj','cep',
        'logradouro','numero','bairro','complemento','uf',
        'cidade','fone','email',
        'celular',
        'status_id',
        'status_plano_id',
        'plano_preco_id',
        "forma_pagto_id",
        'data_aquisicao',
        "valor_contrato",
        "data_vencimento",
        "tipo_recorrencia",
        "data_inicial_vencimento",
        "valor_recorrente",
        "dias_bloqueia",
        'uuid'
        
    ];
    
    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
    
    public function assinatura(){
        return $this->hasOne(Assinatura::class, 'empresa_id', 'id');
    }
    
    public function faturas(){
        return $this->hasMany(FinFatura::class, 'empresa_id', 'id');
    }
    public function planopreco()
    {
        return $this->belongsTo(PlanoPreco::class,"plano_preco_id");
    }
    
    public function forma_pagto()
    {
        return $this->belongsTo(FormaPagto::class,"forma_pagto_id");
    }
    
    public function statusplano()
    {
        return $this->belongsTo(Status::class,"status_plano_id");
    }
    
    public function status()
    {
        return $this->belongsTo(Status::class,"status_id");
    }
    public function pagamentos(){
        return $this->hasMany(FinPagamento::class, 'empresa_id', 'id')->where("tipo_documento", config("constantes.tipo_documento.FATURA"));
    }
    
    
    
}
