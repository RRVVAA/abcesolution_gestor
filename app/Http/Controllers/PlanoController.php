<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Plano;
use App\Models\PlanoModulo;
use App\Models\PlanoPreco;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Assinatura;
use App\Http\Requests\PlanoRequest;

class PlanoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados["lista"] = Plano::get();
        return view("Plano.Index", $dados);
    }

    
    public function create()
    {
        $dados = array();
        return view("Plano.Create", $dados);
    }

    
    public function store(PlanoRequest $request)
    {   
        try {
            $req            = $request->except(["_token","_method"]);
            $req["valor_setup"] = $req["valor_setup"] ? getFloat($req["valor_setup"]) : 0;
            $tem = Plano::where("nome", $request->nome)->first();
            if($tem){
                throw(new \Exception('Já existe um plano com este nome'));
            }
            Plano::Create($req);
            return redirect()->route('plano.index');
        } catch (\Exception $e) {
            return redirect()->back()->with("msg_erro", "erro: " . $e->getMessage());
        }
        
    }

    public function modulos($id)
    {
        $dados["plano"]     = Plano::find($id);
        $dados["modulos"]   = Modulo::all();
        $dados["lista"]     = PlanoModulo::where("plano_id", $id)->get();
        return view("Plano.Modulo", $dados);
    }
    
    
    public function vincular(Request $request,$id_plano){
        if (!$plano = Plano::find($id_plano)) {
            return redirect()->back();        
        }
            
        $dados["filtro"]            = $request->except('_token');
        $dados["plano"]             = $plano;
        $dados["lista"]             = $plano->modulosNaoInseridos($request->filtro);
        
        return view('Plano.Vincular', $dados);
    }
    
    
    
    public function precos($id)
    {
        $dados["plano"]     = Plano::find($id);
        $dados["lista"]     = PlanoPreco::where("plano_id", $id)->get();
        return view("Plano.Preco", $dados);
    }
    
    public function editarPreco($planopreco_id)
    {
        $planopreco             = PlanoPreco::find($planopreco_id);
        
        $dados["planopreco"]    = $planopreco;
        $dados["plano"]         = Plano::find($planopreco->plano_id);
        $dados["lista"]         = PlanoPreco::where("plano_id", $planopreco->plano_id)->get();
        
        return view("Plano.Preco", $dados);
    }
    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $dados["plano"] = Plano::find($id);
        $dados["lista"] = Plano::all();
        return view('Plano.Index', $dados);
    }

    public function update(Request $request, $id)
    {
        $req                =   $request->except(["_token","_method"]);
        
        $req["valor_setup"] = ($req["valor_setup"]) ? moedaEN($req["valor_setup"]) : 0;
        Plano::where("id", $id)->update($req);
        return redirect()->route("plano.index");
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
            PlanoModulo::where("plano_id", $id)->delete();
            PlanoPreco::where("plano_id", $id)->delete();
            $h = Plano::find($id);
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "Ítem apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            $msg = $e->getMessage();
            
            return redirect()->back()->with('msg_erro', "Erro: ". $msg);
        }
    }
}
