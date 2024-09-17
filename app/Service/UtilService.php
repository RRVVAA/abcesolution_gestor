<?php
namespace App\Service;

class UtilService
{
    public static function buscarCNPJ($cnpj){
        $retorno =  enviarGetCurl("http://receitaws.com.br/v1/cnpj/".$cnpj);
        
        $empresa = new \stdClass();
        $empresa->razao_social  = $retorno->nome;
        $empresa->nome_fantasia = $retorno->fantasia;
        
        $empresa->numero        = $retorno->numero;
        $empresa->bairro        = $retorno->bairro;
        $empresa->complemento   = $retorno->complemento;
        $empresa->cnpj          = $retorno->cnpj;
        $empresa->cep           = tira_mascara($retorno->cep);
        $empresa->telefone      = $retorno->telefone;
        $empresa->email         = $retorno->email;
        $empresa->abertura      = dataen($retorno->abertura);
        $empresa->ultima_atualizacao = dataNfe($retorno->ultima_atualizacao) . " " . horaNfe($retorno->ultima_atualizacao) ;
        $endereco               = enviarGetCurl("https://viacep.com.br/ws/" . $empresa->cep . "/json/");
        if($endereco){
            $empresa->logradouro= $endereco->logradouro;
            $empresa->cidade    = $endereco->localidade;
            $empresa->bairro    = $endereco->bairro;
            $empresa->uf        = $endereco->uf;
            $empresa->ibge      = $endereco->ibge;
            $empresa->ddd       = $endereco->ddd;
        }
        return $empresa;
    }
}

