<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emitente extends Model
{
    protected $fillable =[
        'empresa_id',
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'ie',
        'iest',
        'im',
        'cep',
        'logradouro',
        'numero',
        'bairro',
        'complemento',
        'uf',
        'email',
        'cidade',
        'fone',
        'ibge',
        'cnae',
        'pais',
        'codPais',
        'crt',
        'cst_csosn_padrao',
        'cst_cofins_padrao',
        'cst_pis_padrao',
        'cst_ipi_padrao',
        'frete_padrao',
        'tipo_pagamento_padrao',
        'nat_op_padrao',
        'ambiente',
        'numero_serie_nfe',
        'numero_serie_nfce',
        'ultimo_numero_nfe',
        'ultimo_numero_nfce',
        'ultimo_numero_cte',
        'ultimo_numero_mdfe',
        'certificado_nome_arquivo',
        'certificado_arquivo_binario',
        'certificado_senha',
        'csc',
        'csc_id',
        'resp_CNPJ',
        'resp_xContato',
        'resp_email',
        'resp_fone',
        'resp_CSRT',
        'resp_idCSRT'
    ];    
    
}
