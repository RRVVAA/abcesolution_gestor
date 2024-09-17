<?php

namespace App\Http\Controllers;

use App\Http\Requests\PagarRequest;
use App\Models\Empresa;
use App\Models\EmpresaPlano;
use App\Models\GestaoFornecedor;
use App\Models\GestaoPagamento;
use App\Models\GestaoDespesa;
use Illuminate\Http\Request;
use App\Models\GestaoTipoDespesa;

class GestaoDespesaController extends Controller
{
    
    public function index()
    {
        $dados["lista"]         = GestaoDespesa::whereMonth("data_vencimento", date('m'))->whereYear("data_vencimento", date('Y'))->get();
        $dados["mes"]           = date('m');        
        return view("Despesa.Index", $dados);
    }
    
    public function pormes(){
        $mes            = $_GET["mes"];
        $ano            = $_GET["ano"];
        $dados["lista"] = GestaoDespesa::whereMonth("data_vencimento", $mes)->whereYear("data_vencimento", $ano)->get();
        $dados["mes"]   = $mes;
        $dados["fornecedores"]  = GestaoFornecedor::get();
        return view("Despesa.Index", $dados);
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
        
        $dados["lista"]         = GestaoDespesa::filtro($filtro);
        $dados["filtro"]        = $filtro;
        $dados["mes"]           = 13;
        $dados["fornecedores"]  = GestaoFornecedor::get();
        return view("Despesa.Index", $dados);
    }
    
 
    
    public function create()
    {
        $dados["fornecedores"] = GestaoFornecedor::all() ;
        $dados["tipos"] = GestaoTipoDespesa::all();
        return view("Despesa.Create", $dados);
    }

    
    public function store(Request $request)
    {
       
        $req = $request->except(["_token","_method"]);
        for($i=0; $i<$req["repete"]; $i++){
            $despesa = new GestaoDespesa();            
            $despesa->fornecedor_id       = $req["fornecedor_id"];
            $despesa->tipo_despesa_id     = $req["tipo_despesa_id"];
            $despesa->descricao           = $req["descricao"];
            $despesa->data_lancamento     = $req["data_lancamento"];
            $despesa->data_vencimento     = somarData($req["data_vencimento"], 30 * $i);
            $despesa->valor               = $req["valor"];
            $despesa->status_id           = config("constantes.status.ABERTO");
            $despesa->save(); 
        }
       
        return redirect()->route('despesa.index');
    }

   
    
    public function show($id)
    {
        $dados["fornecedores"] = GestaoFornecedor::all() ;
        $dados["despesa"] = GestaoDespesa::find($id);
        return view('Pagar.Show', $dados);
    }

    public function faturar($id)
    {
        $despesa = GestaoDespesa::find($id);
        if($despesa->pagamento_id){
            return redirect()->route('despesa.detalhe', $id)->with('msg_erro', "Essa conta não pode mais ser modificada.");
        }
       
        $dados["despesa"] = GestaoDespesa::find($id);
        return view('Despesa.Faturar', $dados);
    }
   
    public function detalhe($id)
    {
        $dados["despesa"] = GestaoDespesa::find($id);
        return view('Despesa.Detalhe', $dados);
    }
    
    public function edit($id)
    {
        $contadespesa = GestaoDespesa::find($id);
        if($contadespesa->pagamento_id){
            return redirect()->route('despesa.detalhe', $id)->with('msg_erro', "Essa conta não pode mais ser modificada.");
        }
        
        $dados["fornecedores"] = GestaoFornecedor::all() ;
        $dados["despesa"] = GestaoDespesa::find($id);
        $dados["tipos"] = GestaoTipoDespesa::all();
        return view('Despesa.Create', $dados);
    }
    
    public function pagar(Request  $request)
    {
        $req                            = $request->except(["_token","_method"]);
        $conta = new \stdClass();
        $conta->descricao_pagamento     = "Despesa #" .$req["despesa_id"];
        $conta->forma_pagto_id          = $req["forma_pagto_id"];
        $conta->data_pagamento          = $req["data_pagamento"];
        $conta->numero_documento        = $req["numero_documento"];
        $conta->observacao              = $req["observacao"];
                
        $conta->valor_original          = ($req["valor_original"]) ? getFloat($req["valor_original"]) : 0;;
        $conta->juros                   = ($req["juros"]) ? getFloat($req["juros"]) : 0;
        $conta->desconto                = ($req["desconto"]) ? getFloat($req["desconto"]) : 0 ;
        $conta->multa                   = ($req["multa"]) ? getFloat($req["multa"]) : 0;
        
        $conta->tipo_documento          = config("constantes.tipo_documento.DESPESA");
        $conta->documento_id            = $req["despesa_id"];
        $conta->valor_pago              = $conta->valor_original + $conta->juros + $conta->multa-$conta->desconto;
        $pag                            = GestaoPagamento::Create(objToArray($conta));
        
        if($pag){
            $contaPagar                 = GestaoDespesa::where("id", $req["despesa_id"])->first();
            $contaPagar->pagamento_id   = $pag->id;
            $contaPagar->status_id      = config("constantes.status.PAGO");
            $contaPagar->save();
        }
            
        return redirect()->route('despesa.index');
    }

    public function update(PagarRequest $request, $id)
    {
        $req               = $request->except(["_token","_method"]);
        $req["valor"]      = ($req["valor"]) ? getFloat($req["valor"]) : 0;
        GestaoDespesa::where("id", $id)->update($req);        
        return redirect()->route('despesa.index');
    }
    
   
    public function destroy($id)
    {
        try{
            $h = GestaoDespesa::find($id);
            if($h->pagamento_id){
                return redirect()->back()->with('msg_erro', "Essa conta não pode ser excluído, pois já foi paga.");
            }
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "Ítem apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            return redirect()->back()->with('msg_erro', "Houve um problema ao adespesa [$cod]");
        }
    }
}
