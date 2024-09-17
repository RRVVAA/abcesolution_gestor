<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Models\PlanoModulo;
use Illuminate\Http\Request;
use App\Models\Plano;

class PlanoPerfilController extends Controller
{
    
    public function index()
    {
        $dados["planomodulo"] = PlanoModulo::all();
        return view("Plano.Index", $dados);
    }

    public function perfil($id_plano)
    {       
        if (!$plano = Plano::find($id_plano)) {
            return redirect()->back();
        }        
        
        $dados["plano"]  = $plano;
        $dados["perfis"] = $plano->perfis()->get();
       
        return view('Plano.Perfis', $dados);
    }
    
    public function vincular(Request $request,$id_plano){
        if (!$plano = Plano::find($id_plano)) {
            return redirect()->back();        }
            
            $dados["filtro"]            = $request->except('_token');
            $dados["plano"]              = $plano;
            $dados["lista"]             = $plano->perfisNaoInseridos($request->filtro);
            
            return view('Plano.Vincular', $dados);
    }
    
    
    
    public function create()
    {
        $dados = array();
        return view("Plano.Create", $dados);
    }

    
    public function store(Request $request){       
        $req = $request->except(["_token","_method"]);
        PlanoModulo::firstOrCreate($req);
        return redirect()->route('plano.modulos', $req["plano_id"]);
    }

    
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
       // $req     =   $request->except(["_token","_method"]);
      //  Categoria::where("id", $id)->update($req);
        return redirect()->route("categoria.index");
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
            $h = PlanoModulo::find($id);
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "Ítem apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            return redirect()->back()->with('msg_erro', "Houve um problema ao apagar [$cod]");
        }
    }
}
