<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestaoFornecedor extends Model
{
    use HasFactory;
    public $fillable = ['razao_social', 'fantasia',  'cpf_cnpj','cep',
        'logradouro','numero','bairro','complemento','uf',
        'cidade','fone','email','status_id', 'ibge'
    ];
}
