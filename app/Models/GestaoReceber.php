<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GestaoReceber extends Model
{
    use HasFactory;
    protected $fillable = [
        "empresa_id",
        "recebimento_id",
        "descricao",
        "data_lancamento",
        "data_recebimento",
        "status_id",
        "observacao",
        "valor"
    ];
    
    public function empresa(){
        return $this->belongsTo(Empresa::class,"empresa_id");
    }    
    
    public function status(){
        return $this->belongsTo(Status::class,"status_id");
    } 
    
    public function recebimento(){
        return $this->belongsTo(GestaoRecebimento::class,"recebimento_id");
    }
    
    public static function filtroPorData($data1, $data2){
        $retorno = self::whereBetween('data_vencimento',[$data1, $data2]);
        return $retorno;
    }
}
