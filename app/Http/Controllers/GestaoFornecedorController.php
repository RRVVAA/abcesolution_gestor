<?php

namespace App\Http\Controllers;

use App\Http\Requests\FornecedorRequest;
use App\Models\GestaoFornecedor;
use App\Service\UtilService;

class GestaoFornecedorController extends Controller{    
    public function index()
    {
        $dados["lista"] = GestaoFornecedor::all();
        return view("Fornecedor.Index", $dados);
    }
   
    public function create()
    {
        
        $dados["fornecedorJs"] = true;
        return view("Fornecedor.Create", $dados);
    }
    
    public function store(FornecedorRequest $request){       
        $req = $request->except(["_token","_method"]);
        $req["status_id"] = config("constantes.status.ATIVO");
        GestaoFornecedor::Create($req);
        return redirect()->route('fornecedor.index');
    }   
    
    public function show($id)
    {
        //
    }

    public function buscarCNPJ($cnpj){
        $retorno = new \stdClass();
        try {
            if(!validarCpfCnpj($cnpj)){
                $retorno->tem_erro = true;
                $retorno->erro = "CPF/CNPJ inválido";
                return response()->json($retorno);
            }
           
            
            $empresa = UtilService::buscarCNPJ($cnpj);
            $retorno->tem_erro = false;
            $retorno->retorno = $empresa;
            return response()->json($retorno);
            echo json_encode($empresa);
        } catch (\Exception $e) {
            $retorno->tem_erro = true;
            $retorno->erro = $e->getMessage();
            return response()->json($retorno);
        }
        
    }
    public function edit($id)
    {
        $dados["fornecedor"] = GestaoFornecedor::find($id);
        return view('Fornecedor.Create', $dados);
    }

    public function update(FornecedorRequest $request, $id)
    {
        $req     =   $request->except(["_token","_method"]);
        GestaoFornecedor::where("id", $id)->update($req);
        return redirect()->route("fornecedor.index");
    }

    public function destroy($id)
    {
        try{           
            $h = GestaoFornecedor::find($id);
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "Ítem apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            return redirect()->back()->with('msg_erro', "Houve um problema ao apagar " . $cod);
        }
    }
}
