<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Models\Permissao;
use Illuminate\Http\Request;

class PermissaoController extends Controller
{
    
    public function index()
    {
        $dados["lista"] = Permissao::all();
        return view("Permissao.Index", $dados);
    }

    
    public function create()
    {
        return view("Categoria.Create");
    }

    public function store(Request $request)
    {
       
        $req = $request->except(["_token","_method"]);
        Permissao::create($req);
        return redirect()->route("permissao.index");
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
        $dados["lista"] = Permissao::all();
        $dados["permissao"] = Permissao::find($id);
        $dados["permissaos"] = Permissao::all();
        return view('Permissao.Index', $dados);
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
        $req     =   $request->except(["_token","_method"]);
        Permissao::where("id", $id)->update($req);
        return redirect()->route("permissao.index");
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
            $h = Permissao::find($id);
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "Ítem apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            return redirect()->back()->with('msg_erro', "Houve um problema ao apagar [$cod]");
        }
    }
}
