<?php

namespace App\Http\Controllers;

use App\Models\FormaPagto;
use App\Models\GestaoRecebimento;
use Illuminate\Http\Request;
use App\Models\GestaoReceber;
use App\Models\FinFatura;

class GestaoRecebimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados["lista"]         = GestaoRecebimento::whereMonth("data_recebimento", date('m'))->whereYear("data_recebimento", date('Y'))->get(); 
        $dados["mes"]           = date('m'); 
        $dados["formas"]        = FormaPagto::get();
        return view("Recebimento.Index", $dados);
    }

    public function pormes()
    {
        $mes            = $_GET["mes"];
        $ano            = $_GET["ano"];
        $dados["lista"] = GestaoRecebimento::whereMonth("data_recebimento", $mes)->whereYear("data_recebimento", $ano)->get();
        $dados["mes"]   = $mes; 
        $dados["formas"]= FormaPagto::get();
        return view("Recebimento.Index", $dados);
    }
    
    public function filtro()
    {
        $filtro                 = new \stdClass();
        $filtro->forma_pagto_id = $_GET["forma_pagto_id"];
        $filtro->data01         = $_GET["data01"];
        $filtro->data02         = $_GET["data02"];
        
        $dados["lista"]         = GestaoRecebimento::filtro($filtro);
        $dados["filtro"]        = $filtro;
        $dados["mes"]           = 13;
        $dados["formas"]        = FormaPagto::get();
        return view("Recebimento.Index", $dados);
    }
    
 
    public function detalhe($id)
    {
        $dados["recebimento"]    = GestaoRecebimento::find($id);
        $dados["formaPagto"]    = FormaPagto::all();
        $dados["recebimentos"] = array();
        return view("Recebimento.Detalhe", $dados);
    }
    
   
    public function create()
    {
        $dados["formaPagto"]    = FormaPagto::all();
        $dados["recebimentos"] = array();
        return view("Recebimento.Create", $dados);
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
     
   
        return redirect()->route('recebimento.index')->with('msg_sucesso', "Inserido com sucesso.");
    }

    public function pagar(Request $request)
    {
        $req = $request->except(["_token","_method"]);
       
        $conta = new \stdClass();
        $conta->usuario_id              = auth()->user()->id;
        $conta->descricao_recebimento   = "Conta a Pagar #" .$req["conta_pagar_id"];
        $conta->forma_pagto_id          = $req["forma_pagto_id"];
        $conta->data_recebimento        = $req["data_recebimento"];
        $conta->numero_documento        = $req["numero_documento"];
        $conta->observacao              = $req["observacao"];
        $conta->valor_original          = $req["valor_original"];
        $conta->juros                   = $req["juros"];
        $conta->desconto                = $req["desconto"];
        $conta->multa                   = $req["multa"];
        $conta->valor_pago              = $conta->valor_original + $conta->juros + $conta->multa-$conta->desconto;
        $pag = GestaoRecebimento::Create(objToArray($conta));
        if($pag){
            GestaoRecebimento::where("id", $req["conta_pagar_id"])->update(["recebimento_id"=>$pag->id, "status_id"=>config("constantes.status.PAGO")]);
        }
        return redirect()->route('recebimento.index')->with('msg_sucesso', "Conta Paga com sucesso.");
    }
    
    
    public function show($id)
    {
        $recebimento = GestaoRecebimento::find($id);
        $dados["recebimento"]= $recebimento;
        $conta_receber= GestaoReceber::where("recebimento_id", $id)->first();  
        $fatura= FinFatura::where("recebimento_id", $id)->first();
        if($conta_receber){
            $dados["conta_receber"] = $conta_receber;
        }elseif($fatura){
            $dados["conta_receber"] = $fatura;
        }
    
        return view('Recebimento.Detalhe', $dados);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $h = GestaoRecebimento::find($id);
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "item apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            return redirect()->back()->with('msg_erro', "Houve um problema ao apagar [$cod]");
        }
    }
}
