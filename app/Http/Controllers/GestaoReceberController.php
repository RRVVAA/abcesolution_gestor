<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceberRequest;
use App\Models\Empresa;
use App\Models\GestaoFornecedor;
use App\Models\GestaoReceber;
use Illuminate\Http\Request;
use App\Models\GestaoRecebimento;

class GestaoReceberController extends Controller
{
    public function index(){
        $dados["lista"]         = GestaoReceber::whereMonth("data_vencimento", date('m'))->whereYear("data_vencimento", date('Y'))->get();
        $dados["mes"]           = date('m');
        
        return view("Receber.Index", $dados);
    }
    public function pormes()
    {
        $mes            = $_GET["mes"];
        $ano            = $_GET["ano"];
        $dados["lista"] = GestaoReceber::whereMonth("data_vencimento", $mes)->whereYear("data_vencimento", $ano)->get();
        $dados["mes"]   = $mes;
        $dados["fornecedores"]  = GestaoFornecedor::get();
        return view("Receber.Index", $dados);
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
        
        $dados["lista"]         = GestaoReceber::filtro($filtro);
        $dados["filtro"]        = $filtro;
        $dados["mes"]           = 13;
        $dados["fornecedores"]  = GestaoFornecedor::get();
        return view("Admin.Financeiro.ContaReceber.Index", $dados);
    }
    public function create()
    {
        $dados["empresas"] = Empresa::where("id","!=",1)->get();
        return view("Receber.Create", $dados);
    }

    
    public function store(ReceberRequest $request)
    {
       
        $req = $request->except(["_token","_method"]);
        for($i=0; $i<$req["repete"]; $i++){
            $receber = new GestaoReceber();            
            $receber->empresa_id        = $req["empresa_id"];
            $receber->descricao         = $req["descricao"];
            $receber->data_lancamento   = $req["data_lancamento"];
            $receber->data_vencimento   = somarData($req["data_vencimento"],30 * $i);
            $receber->valor             = $req["valor"];
            $receber->status_id         = config("constantes.status.ABERTO");
            $receber->save(); 
        }
       
        return redirect()->route('receber.index');
    }

  
    
    public function show($id)
    {
        $dados["conta_receber"] = GestaoReceber::find($id);
        return view('Receber.Show', $dados);
    }

    public function faturar($id)
    {
        $contareceber = GestaoReceber::find($id);
        if($contareceber->recebimento_id){
            return redirect()->route('receber.detalhe', $id)->with('msg_erro', "Essa conta não pode mais ser modificada.");
        }
        
        $dados["conta_receber"] = GestaoReceber::find($id);
        return view('Receber.Faturar', $dados);
    }
    
    public function edit($id)
    {
        $dados["empresas"] = Empresa::all() ;
        $dados["conta_receber"] = GestaoReceber::find($id);
        return view('Receber.Edit', $dados);
    }

    public function detalhe($id)
    {
        $dados["conta_receber"] = GestaoReceber::find($id);
        return view('Receber.Detalhe', $dados);
    }
    
    public function update(ReceberRequest $request, $id)
    {
        $req     =   $request->except(["_token","_method"]);
        $req["valor"]      = ($req["valor"]) ? getFloat($req["valor"]) : 0;
        GestaoReceber::where("id", $id)->update($req);        
        return redirect()->route('receber.index');
    }

    public function receber(Request $request)
    {
        $req                            = $request->except(["_token","_method"]);
        
        $conta                          = new \stdClass();
        $conta->descricao_recebimento   = "Conta a Receber #" .$req["conta_receber_id"];
        $conta->forma_pagto_id          = $req["forma_pagto_id"];
        $conta->data_recebimento        = $req["data_recebimento"];
        $conta->numero_documento        = $req["numero_documento"];
        $conta->observacao              = $req["observacao"];
        
        $conta->valor_original          = ($req["valor_original"]) ? getFloat($req["valor_original"]) : 0;;
        $conta->juros                   = ($req["juros"]) ? getFloat($req["juros"]) : 0;
        $conta->desconto                = ($req["desconto"]) ? getFloat($req["desconto"]) : 0 ;
        $conta->multa                   = ($req["multa"]) ? getFloat($req["multa"]) : 0;
        
        
        $conta->tipo_documento          = config("constantes.tipo_documento.CONTA_RECEBER");
        $conta->documento_id            = $req["conta_receber_id"];
        $conta->valor_recebido          = $conta->valor_original + $conta->juros + $conta->multa-$conta->desconto;
       
        $pag                            = GestaoRecebimento::Create(objToArray($conta));
        
        if($pag){
            $contaReceber                 = GestaoReceber::where("id", $req["conta_receber_id"])->first();
            $contaReceber->recebimento_id = $pag->id;
            $contaReceber->status_id      = config("constantes.status.PAGO");
            $contaReceber->save();
        }
        
        return redirect()->route('receber.index');
    }
    
    
    public function destroy($id)
    {
        try{
            $h = GestaoReceber::find($id);
          
            if($h->recebimento_id){
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
