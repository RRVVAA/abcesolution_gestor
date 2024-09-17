<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestaoTipoDespesa extends Model
{
    use HasFactory;
    protected $fillable =[
        "nome"
    ];
}
