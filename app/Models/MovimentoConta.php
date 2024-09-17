<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovimentoConta extends Model
{
    use HasFactory;
    protected $fillable =[
        'empresa_id',
        'conta_id',
        'sangria_id',
        'suplemento_id',
        'recebimento_id',
        'documento',
        'data_emissao',
        'data_compensacao',
        'tipo_movimento',
        'historico',
        'valor',
        'usuario_id',
        'classificacao_financeira_id',
    ];
    


   
}
