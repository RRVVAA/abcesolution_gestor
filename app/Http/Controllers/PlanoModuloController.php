<?php

namespace App\Http\Controllers;

use App\Models\Plano;
use App\Models\PlanoModulo;
use Illuminate\Http\Request;

class PlanoModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados["planomodulo"] = PlanoModulo::all();
        return view("Plano.Index", $dados);
    }

    
    public function create()
    {
        $dados = array();
        return view("Plano.Create", $dados);
    }

    public function vincularModulo(Request $request, $idPlano)
    {
        if (!$plano = Plano::find($idPlano)) {
            return redirect()->back();
        }
        
        if (!$request->modulos || count($request->modulos) == 0) {
            return redirect()
            ->back()
            ->with('msg_erro', 'Precisa escolher pelo menos um modulo');
        }
        
        
        $plano->modulos()->attach($request->modulos);
        
        return redirect()->route('plano.modulos', $plano->id);
    }
    
    
    
    public function store(Request $request){       
        $req = $request->except(["_token","_method"]);
        PlanoModulo::firstOrCreate($req);
        return redirect()->route('plano.modulos', $req["plano_id"]);
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
