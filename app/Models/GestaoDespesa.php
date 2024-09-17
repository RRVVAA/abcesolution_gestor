<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestaoDespesa extends Model
{
    use HasFactory;
    protected $fillable =[
        "fornecedor_id",
        "pagamento_id",
        "tipo_despesa_id",
        "status_id",
        "valor",
        "descricao",
        "data_lancamento",
        "data_vencimento"
    ];
    
    
    
    public function empresa(){
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
    
    public function tipodespesa(){
        return $this->belongsTo(GestaoTipoDespesa::class, 'tipo_despesa_id');
    }
    
    public function pagamento(){
        return $this->belongsTo(GestaoPagamento::class, 'pagamento_id');
    }
    
    public function status(){
        return $this->belongsTo(Status::class, 'status_id');
    }
    
    public function fornecedor(){
        return $this->belongsTo(GestaoFornecedor::class, 'fornecedor_id');
    }
    
    public static function filtroPorData($data1, $data2){
        $retorno = self::whereBetween('data_vencimento',[$data1, $data2]);
        return $retorno;
    }
    
    public static function filtro($filtro){
        $retorno = GestaoDespesa::orderBy('gestao_despesas.data_vencimento', 'asc');
        if($filtro->fornecedor_id){
            $retorno->where("fornecedor_id", $filtro->fornecedor_id);
        }
        
        if($filtro->tipo_despesa_id){
            $retorno->where("tipo_despesa_id", $filtro->tipo_despesa_id);
        }
        
        if($filtro->status_id){
            $retorno->where("status_id", $filtro->status_id);
        }
        
        if($filtro->venc01){
            if($filtro->venc02){
                $retorno->where("data_vencimento",">=", $filtro->venc01)->where("data_vencimento","<=", $filtro->venc02);
            }else{
                $retorno->where("data_vencimento", $filtro->venc01);
            }
        }
        
        if($filtro->emissao01){
            if($filtro->emissao02){
                $retorno->where("data_lancamento",">=", $filtro->emissao01)->where("data_lancamento","<=", $filtro->emissao02);
            }else{
                $retorno->where("data_lancamento", $filtro->emissao01);
            }
        }
        
        return $retorno->get();
    }
}
