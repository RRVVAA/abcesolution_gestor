<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanoPrecoRequest;
use App\Models\PlanoPreco;

class PlanoPrecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados["planopreco"] = PlanoPreco::all();
        return view("Plano.Index", $dados);
    }

    
    public function create()
    {
        $dados = array();
        return view("Plano.Create", $dados);
    }

    
    public function store(PlanoPrecoRequest $request){       
        $req = $request->except(["_token","_method"]);
        $req["status_id"]= config("constantes.status.ATIVO");
        PlanoPreco::firstOrCreate($req);
        return redirect()->route('plano.precos', $req["plano_id"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function buscarPlano($plano_id, $recorrencia_id)
    {
        $planopreco = PlanoPreco::where(["plano_id" => $plano_id, "recorrencia" => $recorrencia_id])->first();
        
        $retorno                = new \stdClass();
        $retorno->plano_preco_id= $planopreco->id;
        $retorno->preco         = $planopreco->preco;
        $retorno->preco_setup   = $planopreco->plano->valor_setup;
        $retorno->total         = $planopreco->plano->valor_setup + $retorno->preco;
        
        echo json_encode($retorno);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // $dados["categoria"] = Categoria::find($id);
        //return view('admin.Categoria.Create', $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanoPrecoRequest $request, $id)
    {
        $req     =   $request->except(["_token","_method"]);
        $req["preco_de"] = ($req["preco_de"]) ? getFloat($req["preco_de"]): 0;
        $req["preco"]    = ($req["preco"]) ? getFloat($req["preco"]): 0;
        PlanoPreco::where("id", $id)->update($req);
        return redirect()->route("plano.precos", $request->plano_id);
        
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
            $h = PlanoPreco::find($id);
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "Ítem apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            return redirect()->back()->with('msg_erro', "Houve um problema ao apagar [$cod]");
        }
    }
}
