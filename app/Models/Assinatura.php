<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assinatura extends Model
{
    use HasFactory;
    public $fillable = ['empresa_id','plano_preco_id','data_inicio_teste', 'data_vencimento_teste',
        'status_id', 'data_aquisicao','valor_contrato','eh_teste','liberado_pelo_gestor','dias_bloqueia',
        'data_vencimento','data_cancelamento','valor_recorrente','bloqueado_pelo_gestor','ultima_fatura_paga'
        
    ]; 
    
    
    
    public function faturas(){
        return $this->hasMany(FinFatura::class, 'assinatura_id', 'id');
    }    
    
    public function planopreco(){
        return $this->belongsTo(PlanoPreco::class,"plano_preco_id");
    } 
    
    public function status(){
        return $this->belongsTo(Status::class,"status_id");
    } 
}
