<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GestaoPagamento extends Model
{
    use HasFactory;
    protected $fillable = [
        "forma_pagto_id",
        "descricao_pagamento",
        "tipo_documento",
        "documento_id",
        "data_pagamento",
        "numero_documento",
        "observacao",
        "valor_original",
        "juros",
        "valor_pago",
        "desconto",
        "multa"
        
    ];
    
    public function forma_pagto(){
        return $this->belongsTo(FormaPagto::class,"forma_pagto_id");
    }
   
    public static function filtroPorData($data1, $data2){
        $retorno = self::whereBetween('data_pagamento',[$data1, $data2]);
        return $retorno;
    }
    
    public static function filtroPorMes($mes, $ano){
        $retorno = self::whereYear('data_pagamento', '=', $ano)
                        ->whereMonth('data_pagamento', '=', $mes)
                        ->get();;
        return $retorno;
    }
}
