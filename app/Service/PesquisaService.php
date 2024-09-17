<?php
namespace App\Service;

use App\Models\GestaoPagamento;

class PesquisaService{
    public static function totalSemana(){
        return GestaoPagamento::whereBetween('data_pagamento',[primeiroDiaSemana(), proximaSemana()])->get();
    }
}

