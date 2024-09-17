<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chamado extends Model
{
    use HasFactory;
    protected $fillable =[
        'empresa_id',
        'status_id',
        'assunto',
        'anexo',
        'descricao'
    ];
    public function empresa(){
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
    public function status(){
        return $this->belongsTo(Status::class, 'status_id');
    }
    public function respostas() {
        return $this->belongsToMany(ChamadoReposta::class,"chamado_repostas");
    }
    
    
}
