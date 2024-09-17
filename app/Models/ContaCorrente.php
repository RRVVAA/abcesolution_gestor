<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContaCorrente extends Model
{
    use HasFactory;
    protected $fillable = ["id","empresa_id","descricao", "banco_id", "agencia","conta","tipo_conta_corrente_id","pix"];
    
    public function empresa(){
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
    
   
}
