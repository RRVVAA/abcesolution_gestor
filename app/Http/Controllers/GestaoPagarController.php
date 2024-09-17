<?php

namespace App\Http\Controllers;

use App\Http\Requests\PagarRequest;
use App\Models\Empresa;
use App\Models\EmpresaPlano;
use App\Models\GestaoFornecedor;
use App\Models\GestaoPagar;
use Illuminate\Http\Request;
use App\Models\GestaoPagamento;


class GestaoPagarController extends Controller
{
    
    public function index()
    {
        $dados["lista"]         = GestaoPagar::whereMonth("data_vencimento", date('m'))->whereYear("data_vencimento", date('Y'))->get();
        $dados["mes"]           = date('m');
        
        return view("Pagar.Index", $dados);
    }
    public function emAtraso() {
        $dados["lista"]         = GestaoPagar::whereMonth("data_vencimento", date('m'))->whereYear("data_vencimento", date('Y'))->get();
        $dados["mes"]           = date('m');
        
        return view("Pagar.Index", $dados);
    }
    public function pormes()
    {
        $mes            = $_GET["mes"];
        $ano            = $_GET["ano"];
        $dados["lista"] = GestaoPagar::whereMonth("data_vencimento", $mes)->whereYear("data_vencimento", $ano)->get();
        $dados["mes"]   = $mes;
        $dados["fornecedores"]  = GestaoFornecedor::get();
        return view("Pagar.Index", $dados);
    }
    
    public function filtro()
    {
        $filtro                 = new \stdClass();
        $filtro->fornecedor_id  = $_GET["fornecedor_id"];
        $filtro->status_id      = $_GET["status_id"];
        $filtro->venc01         = $_GET["venc01"];
        $filtro->venc02         = $_GET["venc02"];
        $filtro->emissao01      = $_GET["emissao01"];
        $filtro->emissao02      = $_GET["emissao02"];
        
        $dados["lista"]         = GestaoPagar::filtro($filtro);
        $dados["filtro"]        = $filtro;
        $dados["mes"]           = 13;
        $dados["fornecedores"]  = GestaoFornecedor::get();
        return view("Admin.Financeiro.ContaPagar.Index", $dados);
    }
    
 
    
    public function create()
    {
        $dados["fornecedores"] = GestaoFornecedor::all() ;
        return view("Pagar.Create", $dados);
    }

    
    public function store(Request $request)
    {
       
        $req = $request->except(["_token","_method"]);
        for($i=0; $i<$req["repete"]; $i++){
            $pagar = new GestaoPagar();            
            $pagar->fornecedor_id       = $req["fornecedor_id"];
            $pagar->descricao           = $req["descricao"];
            $pagar->data_lancamento     = $req["data_lancamento"];
            $pagar->data_vencimento     = somarData($req["data_vencimento"], 30 * $i);
            $pagar->valor               = $req["valor"];
            $pagar->status_id           = config("constantes.status.ABERTO");
            $pagar->save(); 
        }
       
        return redirect()->route('pagar.index');
    }

    public function planos($id)
    {
        $dados["empresa"] = Empresa::find($id);
        $dados["lista"]  = EmpresaPlano::where("empresa_id",$id)->get();        
        return view('Cliente.Planos', $dados);
    }
    
    public function show($id)
    {
        $dados["fornecedores"] = GestaoFornecedor::all() ;
        $dados["conta_pagar"] = GestaoPagar::find($id);
        return view('Pagar.Show', $dados);
    }

    public function faturar($id)
    {
        $contapagar = GestaoPagar::find($id);
        if($contapagar->pagamento_id){
            return redirect()->route('pagar.detalhe', $id)->with('msg_erro', "Essa conta não pode mais ser modificada.");
        }
       
        $dados["conta_pagar"] = GestaoPagar::find($id);
        return view('Pagar.Faturar', $dados);
    }
   
    public function detalhe($id)
    {
        $dados["conta_pagar"] = GestaoPagar::find($id);
        return view('Pagar.Detalhe', $dados);
    }
    
    public function edit($id)
    {
        $contapagar = GestaoPagar::find($id);
        if($contapagar->pagamento_id){
            return redirect()->route('pagar.detalhe', $id)->with('msg_erro', "Essa conta não pode mais ser modificada.");
        }
        
        $dados["fornecedores"] = GestaoFornecedor::all() ;
        $dados["conta_pagar"] = GestaoPagar::find($id);
        return view('Pagar.Create', $dados);
    }
    
    public function pagar(Request  $request)
    {
        $req                            = $request->except(["_token","_method"]);
        
        $conta = new \stdClass();
        $conta->descricao_pagamento     = "Conta a Pagar #" .$req["conta_pagar_id"];
        $conta->forma_pagto_id          = $req["forma_pagto_id"];
        $conta->data_pagamento          = $req["data_pagamento"];
        $conta->numero_documento        = $req["numero_documento"];
        $conta->observacao              = $req["observacao"];
        
        $conta->valor_original          = ($req["valor_original"]) ? getFloat($req["valor_original"]) : 0;;
        $conta->juros                   = ($req["juros"]) ? getFloat($req["juros"]) : 0;
        $conta->desconto                = ($req["desconto"]) ? getFloat($req["desconto"]) : 0 ;
        $conta->multa                   = ($req["multa"]) ? getFloat($req["multa"]) : 0;
        
        $conta->tipo_documento          = config("constantes.tipo_documento.CONTA_PAGAR");
        $conta->documento_id            = $req["conta_pagar_id"];
        $conta->valor_pago              = $conta->valor_original + $conta->juros + $conta->multa-$conta->desconto;
     
        $pag                            = GestaoPagamento::Create(objToArray($conta));
        
        if($pag){
            $contaPagar                 = GestaoPagar::where("id", $req["conta_pagar_id"])->first();
            $contaPagar->pagamento_id   = $pag->id;
            $contaPagar->status_id      = config("constantes.status.PAGO");
            $contaPagar->save();
        }
            
        return redirect()->route('pagar.index');
    }

    public function update(PagarRequest $request, $id)
    {
        $req               = $request->except(["_token","_method"]);
        $req["valor"]      = ($req["valor"]) ? getFloat($req["valor"]) : 0;
        GestaoPagar::where("id", $id)->update($req);        
        return redirect()->route('pagar.index');
    }
    
   
    public function destroy($id)
    {
        try{
            $h = GestaoPagar::find($id);
            if($h->pagamento_id){
                return redirect()->back()->with('msg_erro', "Essa conta não pode ser excluído, pois já foi paga.");
            }
            
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "Ítem apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            return redirect()->back()->with('msg_erro', "Houve um problema ao apagar [$cod]");
        }
    }
}
