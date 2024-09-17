<?php

namespace App\Http\Controllers;

use App\Models\GestaoPagamento;
use App\Models\FormaPagto;
use Illuminate\Http\Request;
use App\Models\GestaoPagar;
use App\Models\GestaoDespesa;

class GestaoPagamentoController extends Controller
{
   public function index()
    {
        $dados["lista"]         = GestaoPagamento::whereMonth("data_pagamento", date('m'))->whereYear("data_pagamento", date('Y'))->get(); 
        $dados["mes"]           = date('m'); 
        $dados["formas"]        = FormaPagto::get();
        return view("Pagamento.Index", $dados);
    }

    public function pormes()
    {
        $mes            = $_GET["mes"];
        $ano            = $_GET["ano"];
        $dados["lista"] = GestaoPagamento::whereMonth("data_pagamento", $mes)->whereYear("data_pagamento", $ano)->get();
        $dados["mes"]   = $mes; 
        $dados["formas"]= FormaPagto::get();
        return view("Pagamento.Index", $dados);
    }
    
    public function filtro()
    {
        $filtro                 = new \stdClass();
        $filtro->forma_pagto_id = $_GET["forma_pagto_id"];
        $filtro->data01         = $_GET["data01"];
        $filtro->data02         = $_GET["data02"];
        
        $dados["lista"]         = GestaoPagamento::filtro($filtro);
        $dados["filtro"]        = $filtro;
        $dados["mes"]           = 13;
        $dados["formas"]        = FormaPagto::get();
        return view("Pagamento.Index", $dados);
    }
    
    public function confirmarPagamento($id)
    {
        $dados["pagamento"]    = GestaoPagamento::find($id);
        $dados["formaPagto"]    = FormaPagto::all();
        $dados["pagamentos"]    = array();
        return view("Pagamento.ConfirmarPagamento", $dados);
    }
    
    public function detalhe($id)
    {
        $dados["pagamento"]    = GestaoPagamento::find($id);
        $dados["formaPagto"]    = FormaPagto::all();
        $dados["pagamentos"] = array();
        return view("Pagamento.Detalhe", $dados);
    }
    
   
    public function create()
    {
        $dados["formaPagto"]    = FormaPagto::all();
        $dados["pagamentos"] = array();
        return view("Pagamento.Create", $dados);
    }

    
    public function store(Request $request)
    {
        $req = $request->except(["_token","_method"]);
        
        $conta = new \stdClass();
        $conta->descricao               = $req["descricao"];
        $conta->fornecedor_id           = $req["fornecedor_id"];
        $conta->centro_custo_id         = $req["centro_custo_id"];
        $conta->data_emissao            = $req["data_emissao"];
        $conta->valor                   = $req["valor"];
        $conta->qtde_parcela            = $req["qtdParcelas"];
        $conta->primeiro_vencimento     = $req["primeiro_vencimento"];
     
   
        return redirect()->route('pagamento.index')->with('msg_sucesso', "Inserido com sucesso.");
    }

    public function pagar(Request $request)
    {
        $req = $request->except(["_token","_method"]);
       
        $conta = new \stdClass();
        $conta->usuario_id              = auth()->user()->id;
        $conta->descricao_pagamento     = "Conta a Pagar #" .$req["conta_pagar_id"];
        $conta->forma_pagto_id          = $req["forma_pagto_id"];
        $conta->data_pagamento          = $req["data_pagamento"];
        $conta->numero_documento        = $req["numero_documento"];
        $conta->observacao              = $req["observacao"];
        $conta->valor_original          = ($req["valor_original"]) ? moedaEN($req["valor_original"]) : 0;;
        $conta->juros                   = ($req["juros"]) ? moedaEN($req["juros"]) : 0;
        $conta->desconto                = ($req["desconto"]) ? moedaEN($req["desconto"]) : 0 ;
        $conta->multa                   = ($req["multa"]) ? moedaEN($req["multa"]) : 0;        
        $conta->valor_pago              =  $conta->valor_original + $conta->juros + $conta->multa - $conta->desconto;
        $pag = GestaoPagamento::Create(objToArray($conta));
        if($pag){
            GestaoPagamento::where("id", $req["conta_pagar_id"])->update(["pagamento_id"=>$pag->id, "status_id"=>config("constantes.status.PAGO")]);
        }
        return redirect()->route('pagamento.index')->with('msg_sucesso', "Conta Paga com sucesso.");
    }
    
    
    public function show($id)
    {
        $pagamento = GestaoPagamento::find($id);
        $dados["pagamento"]= $pagamento;
        $conta_pagar= GestaoPagar::where("pagamento_id", $id)->first();
        $despesa= GestaoDespesa::where("pagamento_id", $id)->first();
        if($conta_pagar){
            $dados["conta_pagar"] = $conta_pagar;
        }elseif($despesa){
            $dados["conta_pagar"] = $despesa;
        }
        
        return view('Pagamento.Detalhe', $dados);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        try{
            $h = GestaoPagamento::find($id);
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "item apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            return redirect()->back()->with('msg_erro', "Houve um problema ao apagar [$cod]");
        }
    }
}
