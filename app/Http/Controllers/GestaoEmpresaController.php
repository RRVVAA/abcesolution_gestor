<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaRequest;
use App\Models\Assinatura;
use App\Models\Emitente;
use App\Models\Empresa;
use App\Models\FinFatura;
use App\Models\FormaPagto;
use App\Models\Parametro;
use App\Models\Plano;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\GestaoRecebimento;
use App\Models\FinPagamento;

class GestaoEmpresaController extends Controller
{
    
    public function index()
    {
        $dados["lista"] = Empresa::where("id","!=",1)->get();
        return view("Empresa.Index", $dados);
    }

    public function assinantes(){
        $dados["lista"] = Empresa::where('status_id',"!=", config("constantes.status.PROSPECTO"))
                          ->where("id","!=",1)
                          ->whereNotNull("plano_preco_id")->get(); 
        return view("Empresa.Index", $dados);
    }
    
    
    public function prospectos(){
        $dados["lista"] = Empresa::where('status_id', config("constantes.status.PROSPECTO"))
                         ->where("id","!=",1)->get(); 
        return view("Empresa.Index", $dados);
    }
    public function create()
    {
        $dados = array();
        $dados["fornecedorJs"] = true;
        return view("Empresa.Create", $dados);
    }
    
    public function store(EmpresaRequest $request)
    {     
        $req                        = $request->except(["_token","_method"]);
        try{            
            $req["pasta"]           = Str::uuid();
            $req["uuid"]            = Str::uuid();
            $req["status_id"]       = config("constantes.status.ATIVO");
            $req["cep"]             = ($req["cep"]) ? tira_mascara($req["cep"]) : null;
            $req["cpf_cnpj"]        = ($req["cpf_cnpj"]) ? tira_mascara($req["cpf_cnpj"]) : null;
            $req["fone"]            = ($req["fone"]) ? tira_mascara($req["fone"]) : null;
            $req["celular"]         = ($req["celular"]) ? tira_mascara($req["celular"]) : null;
            if($request->cpf_cnpj){
                $tem = Empresa::where("cpf_cnpj", tira_mascara($request->cpf_cnpj))->first();
                if(!$tem){
                    Empresa::Create($req);
                }
                
            }
            
            return redirect()->route('empresa.index');
        } catch (\Exception $e){
            return redirect()->back()->with('msg_erro', "Erro: " . $e->getMessage());
        }
        
        
    }
    
    public function gerarFatura(Request $request){
        $req                    = $request->except(["_token","_method"]);
        $empresa                = Empresa::find($req["empresa_id"]);    
     
        $fat                    = new \stdClass();
        $fat->descricao         = "Fatura do Plano: " . $empresa->planopreco->plano->nome ;
        $fat->empresa_id        = $empresa->id;
        $fat->forma_pagto_id    = $req["forma_pagto_id"];
        $fat->status_id         = config("constantes.status.ABERTO");
        $fat->data_emissao      = hoje();
        $fat->data_vencimento   = $req["data_vencimento"];
        $fat->valor             = $empresa->planopreco->preco;
        $fat->num_fatura        = 1;
        $fat->inicio_vigencia   = hoje();
        $fat->fim_vigencia      = $req["data_vencimento"];
        
        //Verifica se tem alguma fatura em aberto se sim, ele atualiza, senão ele cria
       $fatura =  FinFatura::Create(objToArray($fat));
       
       if($fatura){
           $empresa->data_vencimento = $req["data_vencimento"];
           $empresa->status_plano_id = ($empresa->data_vencimento > hoje()) ?  config("constantes.status.EM_DIAS") : config("constantes.status.ATRASADO");;
           $empresa->status_id       = config("constantes.status.ATIVO");
           $empresa->save();
       }
        
               
        return redirect()->back()->with("msg_sucesso","Operação realizada com sucesso!");
    }
    
    

    public function criarplano($id)
    {
        $dados["empresa"]       = Empresa::find($id);
        $dados["planos"]        = Plano::get();
        $dados["forma_pagto"]   = FormaPagto::whereIn('id',
            [
                Config('constantes.forma_pagto.BOLETO_BANCARIO'),
                Config('constantes.forma_pagto.PIX'),
                Config('constantes.forma_pagto.CARTAO_CREDITO'),
                Config('constantes.forma_pagto.DEPOSITO_BANCARIO'),
            ]
            )->get();
 
        return view('Empresa.CriarPlano', $dados);
    }
    
    public function criarfatura($id)
    {
        $dados["empresa"]       = Empresa::find($id);
        $dados["planos"]        = Plano::where('id',"<>", 1)->get();
        
        return view('Empresa.CriarFatura', $dados);
    }
    
    public function fatura($id)
    {
        $dados["empresa"]       = Empresa::find($id);
        $dados["forma_pagto"]   = FormaPagto::whereIn('id',
            [
                Config('constantes.forma_pagto.BOLETO_BANCARIO'),
                Config('constantes.forma_pagto.PIX'),
                Config('constantes.forma_pagto.CARTAO_CREDITO'),
                Config('constantes.forma_pagto.DEPOSITO_BANCARIO'),
            ]
            )->get();
        $dados["lista"]    = FinFatura::where("empresa_id",$id)->get();
        return view('Empresa.Fatura', $dados);
    }
    
    
    
    public function alterarDias(Request $request)
    {
        
        $empresa  = Empresa::find($request->id);
        $empresa->dias_bloqueia = $request->dias_bloqueia;        
        $empresa->save();
        return redirect()->back()->with('msg_sucesso', "Alterado com sucesso.");
    }
    
    public function show($id)
    {
        $dados["empresa"]       = Empresa::find($id);
        $dados["recebimentos"]  = FinPagamento::where('empresa_id', $id)->where("tipo_documento", config("constantes.tipo_documento.FATURA"))->get();
        $dados["assinaturas"]   = Assinatura::where("empresa_id", $dados["empresa"]->id)->get();
        return view('Empresa.Detalhe', $dados);
    }
    
    public function pagamento($id)
    {
        $pagamento              = FinPagamento::find($id);
       
        $dados["pagamento"]     = $pagamento;
        $dados["empresa"]       = Empresa::find($pagamento->empresa_id);
        $dados["fatura"]        = FinFatura::find($pagamento->fatura_id);
        $dados["formaPagto"]    = FormaPagto::all();
        $dados["pagamentos"] = array();
        return view('Empresa.PagamentoFatura', $dados);
    }
    
    public function edit($id)
    {
        $dados["empresa"] = Empresa::find($id);
        $dados["fornecedorJs"] = true;
        return view('Empresa.Create', $dados);
    }

    public function update(Request $request, $id)
    {
        $req                    = $request->except(["_token","_method"]);
        $req["cep"]             = ($req["cep"]) ? tira_mascara($req["cep"]) : null;
        $req["cpf_cnpj"]        = ($req["cpf_cnpj"]) ? tira_mascara($req["cpf_cnpj"]) : null;
        $req["fone"]            = ($req["fone"]) ? tira_mascara($req["fone"]) : null;
        $req["celular"]         = ($req["celular"]) ? tira_mascara($req["celular"]) : null;
        Empresa::where("id", $id)->update($req);
        return redirect()->route("empresa.index");
    }

    public function destroy($id)
    {
        try{           
            $h = Empresa::find($id);
            Emitente::where("empresa_id", $h->id)->delete();
            Parametro::where("empresa_id", $h->id)->delete();   
            User::where("empresa_id", $h->id)->delete(); 
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "Ítem apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            return redirect()->back()->with('msg_erro', "Houve um problema ao apagar " . $cod);
        }
    }
}
