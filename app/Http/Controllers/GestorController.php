<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\FinFatura;
use App\Models\GestaoGestor;
use App\Models\GestaoPagamento;
use App\Models\GestaoPagar;
use App\Models\GestaoReceber;
use App\Models\GestaoRecebimento;
use App\Service\GraficoService;
use Illuminate\Http\Request;
use App\Models\GestaoDespesa;
use App\Models\Chamado;
use App\Models\FinComprovanteFatura;
use App\Models\Assinatura;


class GestorController extends Controller{   
    
    public function index(){
        $total_fatura               = FinFatura::filtroPorData(primeiroDiaSemana(), ultimoDiaSemana())->whereNull("recebimento_id")->sum("valor");
        $total_receber              = GestaoReceber::filtroPorData(primeiroDiaSemana(), ultimoDiaSemana())->whereNull("recebimento_id")->sum("valor");
        $total_pagar                = GestaoPagar::filtroPorData(primeiroDiaSemana(), ultimoDiaSemana())->whereNull("pagamento_id")->sum("valor");   
        $total_despesa              = GestaoDespesa::filtroPorData(primeiroDiaSemana(), ultimoDiaSemana())->whereNull("pagamento_id")->sum("valor");
        
        $total_pagamento            = GestaoPagamento::filtroPorData(primeiroDiaSemana(), ultimoDiaSemana())->sum("valor_original");
        $total_pagamento_juros      = GestaoPagamento::filtroPorData(primeiroDiaSemana(), ultimoDiaSemana())->sum("valor_pago");
        
        $total_recebimento          = GestaoRecebimento::filtroPorData(primeiroDiaSemana(), ultimoDiaSemana())->sum("valor_original");
        $total_recebimento_juros    = GestaoRecebimento::filtroPorData(primeiroDiaSemana(), ultimoDiaSemana())->sum("valor_recebido");
        
       
       
        $dados["qtde_assinantes"]   = Assinatura::distinct("empresa_id")->count();
     
        $dados["prospectos"]        = Empresa::where('status_id', config("constantes.status.PROSPECTO"))->limit(15)->get();
        $dados["atrasados"] = array();
       // $dados["atrasados"]         = Assinatura::where('status_plano_id', config("constantes.status.VENCIDO"))->get();
        $dados["chamados"]          = Chamado::where('status_id', config("constantes.status.ABERTO"))->get();
        
        $dados["entradas"]          = GraficoService::gerarEntradas(date("Y"));
        $dados["atraso"]            = GestaoPagar::contasEmAtraso();
       
        $dados["saidas"]            = GraficoService::gerarSaidas(date("Y"));
        
        $dados["total_despesa"]     = $total_despesa;
        $dados["total_pagar"]       = $total_pagar;
        $dados["total_pagamento"]   = $total_pagamento;
        $dados["total_pagamento_juros"]= $total_pagamento_juros;
        
        $dados["saldo_pagar"]       = $total_pagar + $total_despesa ;
        
        $dados["total_fatura"]      = $total_fatura;
        $dados["total_receber"]     = $total_receber;
        $dados["total_recebimento"] = $total_recebimento;
        $dados["total_recebimento_juros"] = $total_recebimento_juros;
        $dados["saldo_receber"]     = $total_receber + $total_fatura;
        
        $dados["comprovantes"]      = FinComprovanteFatura::where("confirmado","N")->get();
        $dados["graficoJs"]         = true;
        return view("home", $dados);
    }
    
    public function resumoContas($valor){
        if($valor=="hoje"){
            $data1 = hoje();
            $data2 = hoje();
        }else if($valor=="semana"){
            $data1 = primeiroDiaSemana();
            $data2 = ultimoDiaSemana();
        }else if($valor=="mes"){
            $data1 = date("Y") ."-" .date("m")."-"."01";
            $data2 = date("Y") ."-" .date("m")."-".ultimoDiaMes(hoje());
        }
   
  
        $total_fatura               = FinFatura::filtroPorData($data1, $data2)->whereNull("recebimento_id")->sum("valor");
        $total_receber              = GestaoReceber::filtroPorData($data1, $data2)->whereNull("recebimento_id")->sum("valor");
        $total_pagar                = GestaoPagar::filtroPorData($data1, $data2)->whereNull("pagamento_id")->sum("valor");
        $total_despesa              = GestaoDespesa::filtroPorData($data1, $data2)->whereNull("pagamento_id")->sum("valor");
        $total_pagamento            = GestaoPagamento::filtroPorData($data1, $data2)->sum("valor_original");
        $total_pagamento_juros      = GestaoPagamento::filtroPorData($data1, $data2)->sum("valor_pago");
        $total_recebimento          = GestaoRecebimento::filtroPorData($data1, $data2)->sum("valor_original");
        $total_recebimento_juros    = GestaoRecebimento::filtroPorData(primeiroDiaSemana(), ultimoDiaSemana())->sum("valor_recebido");
        
       
        $retorno                            = new \stdClass();
        $retorno->total_despesa             = moedaBr($total_despesa);
        $retorno->total_pagar               = moedaBr($total_pagar);
        $retorno->saldo_pagar               = moedaBr($total_pagar + $total_despesa );
        $retorno->total_pagamento           = moedaBr($total_pagamento);
        $retorno->total_pagamento_juros     = moedaBr($total_pagamento_juros);
        $retorno->total_juros_pago          = moedaBr($total_pagamento_juros - $total_pagamento);
        
        $retorno->total_fatura              = moedaBr($total_fatura);
        $retorno->total_receber             = moedaBr($total_receber);
        $retorno->total_recebimento         = moedaBr($total_recebimento);
        $retorno->total_recebimento_juros   = moedaBr($total_recebimento_juros);
        $retorno->saldo_receber             = moedaBr($total_receber + $total_fatura );   
        $retorno->total_juros_recebido       = moedaBr($total_recebimento_juros - $total_recebimento);
        echo json_encode($retorno);
            
    }
    public function configuracao(){
        $dados["gestorJs"] = true;
        $dados["gestor"]   = GestaoGestor::first();
        return view("Configuracao", $dados);
    }
    
    public function salvar(Request $request){
        $req     = $request->except(["_token","_method","file"]);        
        if($_FILES["file"]["name"]){
            $req["certificado_arquivo_binario"] = file_get_contents($_FILES["file"]["tmp_name"]);
        }        
        GestaoGestor::where("id", session('gestor')->id)->update($req);
        session(['gestor_ativo'=>true]);
        session(['gestor'=>GestaoGestor::find(session('gestor')->id)]);
        
        return redirect()->route("index")->with('msg_sucesso', "item alterado com sucesso.");;
    }
    
 
}
