<?php
namespace App\Service;

use App\Models\GestaoRecebimento;
use App\Models\GestaoPagamento;

class GraficoService{
    public static function gerarEntradas($ano){
        $lista= array();
        for($i=0; $i<=11; $i++){
            $qtde = GestaoRecebimento::filtroPorMes($i+1, $ano)->sum("valor_recebido");            
            $lista[$i] = $qtde;
        }
        return $lista;
    }
    
    public static function gerarSaidas($ano){
        $lista= array();
        for($i=0; $i<=11; $i++){
            $qtde = GestaoPagamento::filtroPorMes($i+1 , $ano)->sum("valor_pago");
            $lista[$i] = $qtde;
        }
        return $lista;
    }
}

