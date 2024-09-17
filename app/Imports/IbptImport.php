<?php

namespace App\Imports;

use App\Models\Ibpt;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class IbptImport implements ToModel, WithHeadingRow
{
    private $uf;
    
    public function __construct($uf){
        $this->uf = $uf;
    }
    
    public function model(array $row)
    {
        
        return new Ibpt([
            "ncm"               => $row['codigo'],
            "ex"                => $row['ex'],
            "uf"                => $this->uf,
            "descricao"         => $row['descricao'],
            "nacionalfederal"   => $row['nacionalfederal'],
            "importadosfederal" => $row['importadosfederal'],
            "estadual"          => $row['estadual'],
            "municipal"         => $row['municipal'],
            "chave"             => $row['chave']
        ]);
    }
}

