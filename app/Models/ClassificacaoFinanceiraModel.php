<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassificacaoFinanceiraModel extends Model
{
    use HasFactory;
    protected $fillable = ['codigo','empresa_id','descricao','titulo_grupo','ativo','receita_despesa'];
}
