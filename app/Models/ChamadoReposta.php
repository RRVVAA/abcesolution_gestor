<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChamadoReposta extends Model
{
    use HasFactory;
    protected $table = "chamado_repostas";
    protected $fillable =[
        'status_id',
        'empresa_id',
        'usuario_id',
        'chamado_id',
        'assunto',
        'anexo',
        'descricao'
    ];
    public function chamado(){
        return $this->belongsTo(Chamado::class);
    }
    
    public function usuario(){
        return $this->belongsTo(User::class);
    }
    
    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }
    public function status(){
        return $this->belongsTo(Status::class);
    }
}
