<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ibpt extends Model
{
    use HasFactory;
    protected $fillable =[
        'ncm',
        'uf',
        'ex',
        'descricao',
        'nacionalfederal',
        'importadosfederal',
        'estadual',
        'municipal',
        'vigenciainicio',
        'vigenciafim',
        'chave',
    ];
}
