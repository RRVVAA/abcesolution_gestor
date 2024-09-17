<?php

namespace App\Http\Controllers;

use App\Models\Assinatura;
use App\Models\Chamado;
use App\Models\ChamadoReposta;
use App\Models\FinComprovanteFatura;
use App\Models\FinFatura;
use App\Service\FaturaService;
use Illuminate\Http\Request;

class ComprovanteController extends Controller
{
    
    public function index()
    {
        $dados["lista"] = FinComprovanteFatura::where("confirmado","N")->get();
        return view("Comprovante.Index", $dados);
    }
      
    public function confirmarPagamento($id){
        $comprovante = FinComprovanteFatura::find($id);
        if($comprovante->planopreco_id){
            return redirect()->route("assinatura.confirmaAssinaturaPeloComprovante", $id);
        }elseif($comprovante->fatura_id ){
            return redirect()->route("fatura.confirmaFaturaPeloComprovante", $id);
        }
        
    }
    
    public function edit($id)
    {
        $dados["chamado"] = Chamado::find($id);
        $dados["respostas"] = ChamadoReposta::where("chamado_id", $id)->get();
        return view('Chamado.Create', $dados);
    }
    
    public function confirmarAssinaturaPeloComprovante(Request $request)    {
        $req                        = $request->except(["_token","_method","forma_pagto_id","comprovante_id"]);
        try{
            $comprovante                = FinComprovanteFatura::find($request->comprovante_id);
            if($comprovante){
                //Verifica se já existe alguma assinatura ativa
                $assinaturaAtiva = Assinatura::where(["empresa_id" => $comprovante->empresa_id,  "status_id"=>config("constantes.status.ATIVO") ])->first();
                if($assinaturaAtiva){
                    $assinaturaAtiva->status_id           = config("constantes.status.CANCELADO");
                    $assinaturaAtiva->data_cancelamento   = hoje();
                    $assinaturaAtiva->save();
                    
                    //Cancela as faturas;
                    $fat_anterior = new \stdClass();
                    $fat_anterior->observacao        = "Cancelado devido Mudançca de plano";
                    $fat_anterior->status_id         = config("constantes.status.CANCELADO");
                    $fat_anterior->data_cancelamento = hoje();
                    FinFatura::where(["assinatura_id"=>$assinaturaAtiva->id,"status_id"=>config("constantes.status.ABERTO")])->update(objToArray($fat_anterior));
                }
                
                //Cria a nova assinatura
                $req["valor_contrato"]  = ($req["valor_contrato"]) ? getFloat($req["valor_contrato"]) : 0;
                $req["valor_recorrente"]= ($req["valor_recorrente"]) ? getFloat($req["valor_recorrente"]) : 0;
                $req["status_id"]       = config("constantes.status.ATIVO");
                $req["eh_teste"]        = "N";
                $req["dias_bloqueia"]   = 0;
                $req["bloqueado_pelo_gestor"]        = "N";
                $req["liberado_pelo_gestor"]        = "N";
                $assinatura             = Assinatura::Create($req);
                if($assinatura){                    
                    $dados                      = new \stdClass();
                    $dados->forma_pagto         = $comprovante->forma_pagto_id;
                    $dados->classificacao_financeira_id = $comprovante->classificacao_id;
                    $dados->conta_corrente_id   = $comprovante->conta_corrente_id;
                    $dados->pagar_fatura        = "S";
                    FaturaService::gerarParcelas($assinatura->id, $dados);                  
                    //confirma o comprovante
                    $comprovante->confirmado = "S";
                    $comprovante->save();
                    
                    
                }
            }
            //verifica se já existe um plano ativo
            
            
            
            return redirect()->route('empresa.index');
        } catch (\Exception $e){
            return redirect()->back()->with('msg_erro', "Erro: " . $e->getMessage());
        }
        
        
    }
    
    
    public function store(Request $request){         
        $req                = $request->except(["_token","_method"]); 
        ChamadoReposta::Create($req);  
        $chamado            = Chamado::find($req["chamado_id"]); 
        $chamado->status_id = config("constantes.status.AGUARDANDO_RESPOSTA");
        $chamado->save(); 
        return redirect()->route("chamado.index")->with("msg_sucesso","Registro alterado com sucesso");
    }

    
}
